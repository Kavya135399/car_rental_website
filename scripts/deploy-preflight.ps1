param(
  [switch]$Strict
)

$ErrorActionPreference = "Stop"

function Say($msg) { Write-Host $msg }

Set-Location (Split-Path -Parent $MyInvocation.MyCommand.Path)
Set-Location ..

Say "== Deploy Preflight (Laravel) =="

$requiredPaths = @(
  "Dockerfile",
  "docker/entrypoint.sh",
  "docker/000-default.conf",
  "public/index.php",
  "public/css/style.css"
)

foreach ($p in $requiredPaths) {
  if (-not (Test-Path $p)) {
    throw "Missing required path: $p"
  }
}

$rg = Get-Command rg -ErrorAction SilentlyContinue

if ($rg) {
  $conflict = & rg -n --hidden --glob '!vendor/**' --glob '!node_modules/**' --glob '!storage/**' '^(<<<<<<<|=======|>>>>>>>)' .
  if ($LASTEXITCODE -eq 0) {
    Say "ERROR: Merge conflict markers found:"
    $conflict | Select-Object -First 50 | ForEach-Object { Say " - $_" }
    throw "Fix merge conflicts before deploy."
  }

  $badImage = & rg -n --hidden 'url\((images/|''images/|"images/)' resources/views
  if ($LASTEXITCODE -eq 0) {
    Say "WARNING: Found relative image urls in Blade views (use {{ asset('images/...') }}):"
    $badImage | Select-Object -First 20 | ForEach-Object { Say " - $_" }
    if ($Strict) { throw "Relative image urls detected." }
  }
}
else {
  Say "WARNING: ripgrep (rg) not found; using slower fallback search."

  $files = Get-ChildItem -Recurse -File -Force -ErrorAction SilentlyContinue | Where-Object {
    $_.FullName -notmatch "\\\\(vendor|node_modules|storage)\\\\" 
  }

  $conflictFiles = @()
  foreach ($f in $files) {
    if (Select-String -Path $f.FullName -Pattern '^(<<<<<<<|=======|>>>>>>>)' -Quiet -ErrorAction SilentlyContinue) {
      $conflictFiles += $f.FullName
      if ($conflictFiles.Count -ge 50) { break }
    }
  }
  if ($conflictFiles.Count -gt 0) {
    Say "ERROR: Merge conflict markers found:"
    $conflictFiles | ForEach-Object { Say " - $_" }
    throw "Fix merge conflicts before deploy."
  }

  $bad = Select-String -Path "resources/views/**/*.blade.php" -Pattern 'url\((images/|''images/|"images/)' -AllMatches -ErrorAction SilentlyContinue
  if ($bad) {
    Say "WARNING: Found relative image urls in Blade views (use {{ asset('images/...') }}):"
    $bad | Select-Object -First 20 | ForEach-Object { Say " - $($_.Path):$($_.LineNumber)" }
    if ($Strict) { throw "Relative image urls detected." }
  }
}

Say "Running artisan caches..."
php artisan config:clear | Out-Null
php artisan config:cache | Out-Null

try { php artisan route:cache | Out-Null } catch { Say "WARNING: route:cache failed (ok if routes use closures)."; if ($Strict) { throw } }
try { php artisan view:cache | Out-Null } catch { Say "WARNING: view:cache failed."; if ($Strict) { throw } }

Say "Preflight OK. Next: push to GitHub and redeploy on your hosting platform."
