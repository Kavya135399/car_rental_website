// Booking availability checker: disables booking if car is not available for selected slot.
(function () {
  function qs(sel) { return document.querySelector(sel); }

  function run() {
    var carIdEl = qs('input[name="car_id"]');
    if (!carIdEl || !carIdEl.value) return;

    var pickupDate = qs('input[name="date"]');
    var pickupTime = qs('input[name="pickup_time"]');
    var returnDate = qs('input[name="return_date"]');
    var dropTime = qs('input[name="drop_time"]');
    var form = qs("form");
    var confirmBtn = qs("#confirmBookingBtn");
    var msg = qs("#availabilityMsg");

    if (!pickupDate || !pickupTime || !returnDate || !dropTime || !form || !confirmBtn || !msg) return;

    function setState(ok, text) {
      if (ok) {
        confirmBtn.disabled = false;
        msg.style.display = "none";
        msg.textContent = "";
      } else {
        confirmBtn.disabled = true;
        msg.style.display = "block";
        msg.textContent = text || "THIS CAR NOT AVAILABLE NOW";
      }
    }

    function buildDateTime(d, t) {
      if (!d || !t) return null;
      // Use local time: "YYYY-MM-DDTHH:mm"
      return d + "T" + t;
    }

    var lastReq = 0;
    function check() {
      var pickupAt = buildDateTime(pickupDate.value, pickupTime.value);
      var dropDate = returnDate.value || pickupDate.value;
      var dropAt = buildDateTime(dropDate, dropTime.value || pickupTime.value);

      if (!pickupAt || !dropAt) return;

      var reqId = ++lastReq;
      fetch("/api/cars/" + encodeURIComponent(carIdEl.value) + "/availability?pickup_at=" + encodeURIComponent(pickupAt) + "&dropoff_at=" + encodeURIComponent(dropAt), {
        headers: { "Accept": "application/json" }
      })
        .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, body: j }; }); })
        .then(function (res) {
          if (reqId !== lastReq) return;
          if (!res.ok) {
            setState(false, "THIS CAR NOT AVAILABLE NOW");
            return;
          }
          var avail = Number(res.body.available_units || 0);
          var total = Number(res.body.total_units || 0);
          if (total <= 0) {
            setState(false, "THIS CAR NOT AVAILABLE NOW");
            return;
          }
          if (avail <= 0) {
            setState(false, "THIS CAR NOT AVAILABLE NOW");
            return;
          }
          setState(true, "");
        })
        .catch(function () {
          // Fail closed: prevent overbooking if API check fails
          setState(false, "THIS CAR NOT AVAILABLE NOW");
        });
    }

    // Initial check and on changes
    ["change", "input"].forEach(function (evt) {
      pickupDate.addEventListener(evt, check);
      pickupTime.addEventListener(evt, check);
      returnDate.addEventListener(evt, check);
      dropTime.addEventListener(evt, check);
    });

    // Prevent submit if disabled
    form.addEventListener("submit", function (e) {
      if (confirmBtn.disabled) {
        e.preventDefault();
        alert("THIS CAR NOT AVAILABLE NOW");
      }
    });

    // Trigger once (after auto-fill behaviors)
    setTimeout(check, 50);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", run);
  } else {
    run();
  }
})();

