import * as THREE from 'three';

function isMobile() {
  return window.matchMedia && window.matchMedia('(max-width: 768px)').matches;
}

function clamp(v, a, b) {
  return Math.max(a, Math.min(b, v));
}

export function initHero3D() {
  const canvas = document.getElementById('p-hero-canvas');
  if (!canvas) return;

  const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  const mobile = isMobile();

  const renderer = new THREE.WebGLRenderer({
    canvas,
    antialias: !mobile,
    alpha: true,
    powerPreference: 'high-performance',
  });

  renderer.setPixelRatio(clamp(window.devicePixelRatio || 1, 1, mobile ? 1.25 : 2));
  renderer.setSize(canvas.clientWidth, canvas.clientHeight, false);
  renderer.shadowMap.enabled = !mobile;
  renderer.shadowMap.type = THREE.PCFSoftShadowMap;

  const scene = new THREE.Scene();
  scene.fog = new THREE.Fog('#050812', 10, 26);

  const camera = new THREE.PerspectiveCamera(40, canvas.clientWidth / canvas.clientHeight, 0.1, 200);
  camera.position.set(0, 0.35, 6.0);

  const ambient = new THREE.AmbientLight(0xffffff, 0.38);
  scene.add(ambient);

  const key = new THREE.DirectionalLight(0xffffff, mobile ? 1.1 : 1.5);
  key.position.set(4, 4, 2);
  key.castShadow = !mobile;
  key.shadow.mapSize.set(1024, 1024);
  scene.add(key);

  const green = new THREE.PointLight('#22c55e', mobile ? 0.9 : 1.2, 20);
  green.position.set(-3.2, 1.2, -2.2);
  scene.add(green);

  const amber = new THREE.PointLight('#fbbf24', mobile ? 0.85 : 1.1, 20);
  amber.position.set(2.6, 0.9, 2.4);
  scene.add(amber);

  // Floor for subtle shadow contact
  const floor = new THREE.Mesh(
    new THREE.PlaneGeometry(22, 22),
    new THREE.MeshStandardMaterial({ color: '#070a12', roughness: 1, metalness: 0 })
  );
  floor.rotation.x = -Math.PI / 2;
  floor.position.y = -0.75;
  floor.receiveShadow = !mobile;
  scene.add(floor);

  // A "car-like" sculpt: sleek base + canopy
  const group = new THREE.Group();
  scene.add(group);

  const baseGeo = new THREE.BoxGeometry(2.2, 0.55, 1.05);
  baseGeo.computeVertexNormals();
  const baseMat = new THREE.MeshPhysicalMaterial({
    color: '#0b1222',
    roughness: 0.22,
    metalness: 0.82,
    clearcoat: 1,
    clearcoatRoughness: 0.25,
    reflectivity: 0.95,
  });
  const base = new THREE.Mesh(baseGeo, baseMat);
  base.castShadow = !mobile;
  group.add(base);

  const canopyGeo = new THREE.BoxGeometry(1.4, 0.38, 0.95);
  const canopyMat = new THREE.MeshPhysicalMaterial({
    color: '#101a33',
    roughness: 0.18,
    metalness: 0.35,
    transmission: 0.35,
    thickness: 0.2,
    clearcoat: 1,
  });
  const canopy = new THREE.Mesh(canopyGeo, canopyMat);
  canopy.position.set(0, 0.42, 0);
  canopy.castShadow = !mobile;
  group.add(canopy);

  // Wheels
  const wheelGeo = new THREE.CylinderGeometry(0.22, 0.22, 0.16, 28);
  const wheelMat = new THREE.MeshStandardMaterial({ color: '#0d0f14', metalness: 0.2, roughness: 0.85 });
  const wheelPos = [
    [-0.9, -0.25, 0.54],
    [0.9, -0.25, 0.54],
    [-0.9, -0.25, -0.54],
    [0.9, -0.25, -0.54],
  ];
  for (const [x, y, z] of wheelPos) {
    const w = new THREE.Mesh(wheelGeo, wheelMat);
    w.rotation.z = Math.PI / 2;
    w.position.set(x, y, z);
    w.castShadow = !mobile;
    group.add(w);
  }

  // Headlight strip
  const lightStrip = new THREE.Mesh(
    new THREE.BoxGeometry(1.85, 0.12, 0.03),
    new THREE.MeshStandardMaterial({ color: '#fbbf24', emissive: '#fbbf24', emissiveIntensity: 1.3 })
  );
  lightStrip.position.set(0, 0.12, 0.58);
  group.add(lightStrip);

  // Particles (cheap point cloud)
  const pCount = mobile ? 180 : 520;
  const pGeo = new THREE.BufferGeometry();
  const pPos = new Float32Array(pCount * 3);
  for (let i = 0; i < pCount; i++) {
    pPos[i * 3 + 0] = (Math.random() - 0.5) * 12;
    pPos[i * 3 + 1] = Math.random() * 5 + 0.2;
    pPos[i * 3 + 2] = (Math.random() - 0.5) * 12;
  }
  pGeo.setAttribute('position', new THREE.BufferAttribute(pPos, 3));
  const pMat = new THREE.PointsMaterial({ color: '#ffffff', size: mobile ? 0.02 : 0.03, opacity: 0.35, transparent: true });
  const points = new THREE.Points(pGeo, pMat);
  scene.add(points);

  let hover = false;
  canvas.addEventListener('pointerenter', () => (hover = true));
  canvas.addEventListener('pointerleave', () => (hover = false));

  const mouse = { x: 0, y: 0 };
  window.addEventListener(
    'pointermove',
    (e) => {
      mouse.x = (e.clientX / Math.max(1, window.innerWidth)) * 2 - 1;
      mouse.y = (e.clientY / Math.max(1, window.innerHeight)) * 2 - 1;
    },
    { passive: true }
  );

  function resize() {
    const w = canvas.clientWidth;
    const h = canvas.clientHeight;
    renderer.setPixelRatio(clamp(window.devicePixelRatio || 1, 1, mobile ? 1.25 : 2));
    renderer.setSize(w, h, false);
    camera.aspect = w / Math.max(1, h);
    camera.updateProjectionMatrix();
  }
  window.addEventListener('resize', resize, { passive: true });
  resize();

  let last = performance.now();
  function tick(now) {
    const dt = Math.min(0.03, (now - last) / 1000);
    last = now;

    if (!reduceMotion) {
      const t = now * 0.001;
      group.position.y = THREE.MathUtils.lerp(group.position.y, -0.05 + Math.sin(t * 1.2) * 0.06, 1 - Math.pow(0.001, dt));

      const tx = (mouse.y * 0.25) + (hover ? 0.08 : 0);
      const ty = (mouse.x * -0.35);
      group.rotation.x = THREE.MathUtils.lerp(group.rotation.x, tx, 1 - Math.pow(0.001, dt));
      group.rotation.y = THREE.MathUtils.lerp(group.rotation.y, ty, 1 - Math.pow(0.001, dt));

      const s = hover ? 1.03 : 1.0;
      group.scale.setScalar(THREE.MathUtils.lerp(group.scale.x, s, 1 - Math.pow(0.001, dt)));

      points.rotation.y = t * 0.04;
    }

    renderer.render(scene, camera);
    requestAnimationFrame(tick);
  }

  requestAnimationFrame(tick);
}

