<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FIRST CRY — Hôpital El Bouni ESH</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
:root {
  --crimson: #c0122c;
  --crimson-dark: #8b0a1f;
  --crimson-light: #e8213f;
  --rose: #fde8ec;
  --ink: #0f0d0d;
  --slate: #2a2a35;
  --muted: #6b6b7a;
  --pearl: #faf8f6;
  --white: #ffffff;
  --border: rgba(192,18,44,0.12);
  --shadow: 0 8px 60px rgba(192,18,44,0.12);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html { scroll-behavior: smooth; }

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--pearl);
  color: var(--ink);
  overflow-x: hidden;
}

/* ── SCROLLBAR ── */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--pearl); }
::-webkit-scrollbar-thumb { background: var(--crimson); border-radius: 10px; }

/* ── UTILITY ── */
.hidden { display: none !important; }

.section-fade {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.7s ease, transform 0.7s ease;
}
.section-fade.visible {
  opacity: 1;
  transform: translateY(0);
}

/* ── NAV ── */
nav {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 100;
  padding: 0 60px;
  height: 76px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgba(250,248,246,0.92);
  backdrop-filter: blur(16px);
  border-bottom: 1px solid var(--border);
  transition: box-shadow 0.3s;
}
nav.scrolled { box-shadow: 0 4px 40px rgba(0,0,0,0.08); }

.nav-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  text-decoration: none;
  cursor: pointer;
}
.nav-logo-icon img {
  width: 45px;
  height: 45px;
  object-fit: contain;
  display: block;
}
.nav-logo-text {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  font-size: 18px;
  color: var(--ink);
  letter-spacing: 0.01em;
}
.nav-logo-sub {
  font-size: 10px;
  color: var(--muted);
  letter-spacing: 0.12em;
  text-transform: uppercase;
  font-weight: 500;
  display: block;
  margin-top: -2px;
}

.nav-links {
  display: flex;
  gap: 40px;
  list-style: none;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
}
.nav-links a {
  font-size: 14px;
  font-weight: 500;
  color: var(--muted);
  text-decoration: none;
  cursor: pointer;
  letter-spacing: 0.02em;
  position: relative;
  padding-bottom: 4px;
  transition: color 0.2s;
}
.nav-links a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--crimson);
  border-radius: 2px;
  transition: width 0.3s ease;
}
.nav-links a:hover, .nav-links a.active {
  color: var(--crimson);
}
.nav-links a:hover::after, .nav-links a.active::after { width: 100%; }

.nav-cta {
  display: flex;
  align-items: center;
  gap: 14px;
}
.btn-outline {
  padding: 9px 22px;
  border: 1.5px solid var(--crimson);
  color: var(--crimson);
  border-radius: 50px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  background: transparent;
  transition: all 0.25s;
  letter-spacing: 0.02em;
}
.btn-outline:hover {
  background: var(--crimson);
  color: white;
  box-shadow: 0 4px 20px rgba(192,18,44,0.3);
}
.btn-solid {
  padding: 9px 24px;
  border: none;
  background: var(--crimson);
  color: white;
  border-radius: 50px;
  font-size: 13px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.25s;
  letter-spacing: 0.02em;
  box-shadow: 0 4px 20px rgba(192,18,44,0.35);
}
.btn-solid:hover {
  background: var(--crimson-dark);
  transform: translateY(-1px);
  box-shadow: 0 6px 28px rgba(192,18,44,0.45);
}

/* ── HERO ── */
#homeSection {
  position: relative;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  overflow: hidden;
}

.hero-slides {
  position: absolute;
  inset: 0;
  z-index: 0;
}
.hero-slide {
  position: absolute;
  inset: 0;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1.5s ease;
}
.hero-slide.active { opacity: 1; }
.hero-slide:nth-child(1) { background-image: url('image.jpg'), linear-gradient(135deg, #1a0608 0%, #3d0b15 100%); }
.hero-slide:nth-child(2) { background-image: url('hopital.jpg'), linear-gradient(135deg, #0d1a2e 0%, #1a2a4a 100%); }
.hero-slide:nth-child(3) { background-image: url('service.jpg'), linear-gradient(135deg, #0a1a0a 0%, #1a3020 100%); }

.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(10,5,5,0.95) 0%,
    rgba(10,5,5,0.6) 50%,
    rgba(10,5,5,0.3) 100%
  );
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 2;
  padding: 0 80px 80px;
  max-width: 860px;
}

.hero-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: rgba(192,18,44,0.18);
  border: 1px solid rgba(192,18,44,0.4);
  color: #f4a0ac;
  padding: 7px 18px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 600;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  margin-bottom: 24px;
}

.hero-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(48px, 7vw, 88px);
  font-weight: 900;
  color: white;
  line-height: 1.03;
  margin-bottom: 20px;
  letter-spacing: -0.02em;
}
.hero-title span {
  color: var(--crimson-light);
}

.hero-desc {
  font-size: 18px;
  color: rgba(255,255,255,0.65);
  font-weight: 300;
  max-width: 520px;
  line-height: 1.7;
  margin-bottom: 40px;
}

.hero-actions {
  display: flex;
  align-items: center;
  gap: 20px;
}
.hero-btn-primary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 34px;
  background: var(--crimson);
  color: white;
  border-radius: 50px;
  font-size: 15px;
  font-weight: 600;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s;
  border: none;
  box-shadow: 0 8px 32px rgba(192,18,44,0.45);
  letter-spacing: 0.02em;
}
.hero-btn-primary:hover {
  background: var(--crimson-light);
  transform: translateY(-2px);
  box-shadow: 0 12px 40px rgba(192,18,44,0.55);
}
.hero-btn-secondary {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 16px 34px;
  border: 1.5px solid rgba(255,255,255,0.3);
  color: white;
  border-radius: 50px;
  font-size: 15px;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.3s;
  background: transparent;
  letter-spacing: 0.02em;
}
.hero-btn-secondary:hover {
  border-color: white;
  background: rgba(255,255,255,0.08);
}

/* Slide dots */
.hero-dots {
  position: absolute;
  bottom: 80px;
  right: 80px;
  z-index: 3;
  display: flex;
  gap: 8px;
}
.hero-dot {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  cursor: pointer;
  transition: all 0.3s;
}
.hero-dot.active {
  background: var(--crimson);
  width: 24px;
  border-radius: 4px;
}

/* Scroll indicator */
.scroll-indicator {
  position: absolute;
  bottom: 32px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 3;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  color: rgba(255,255,255,0.4);
  font-size: 11px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}
.scroll-line {
  width: 1px;
  height: 40px;
  background: linear-gradient(to bottom, var(--crimson), transparent);
  animation: scrollAnim 1.8s ease-in-out infinite;
}
@keyframes scrollAnim {
  0% { transform: scaleY(0); transform-origin: top; }
  50% { transform: scaleY(1); transform-origin: top; }
  51% { transform: scaleY(1); transform-origin: bottom; }
  100% { transform: scaleY(0); transform-origin: bottom; }
}

/* ── STATS BAR ── */
.stats-bar {
  background: white;
  border-bottom: 1px solid var(--border);
  padding: 0;
}
.stats-inner {
  max-width: 1200px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
}
.stat-item {
  padding: 32px 40px;
  border-right: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 18px;
}
.stat-item:last-child { border-right: none; }
.stat-icon {
  width: 48px;
  height: 48px;
  background: var(--rose);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--crimson);
  font-size: 18px;
  flex-shrink: 0;
}
.stat-num {
  font-family: 'Playfair Display', serif;
  font-size: 28px;
  font-weight: 700;
  color: var(--ink);
  line-height: 1;
}
.stat-label {
  font-size: 12px;
  color: var(--muted);
  margin-top: 4px;
  font-weight: 500;
  letter-spacing: 0.03em;
}

/* ── FEATURES ── */
#featuresSection {
  padding: 100px 80px;
  background: var(--pearl);
}
.section-header {
  margin-bottom: 64px;
}
.section-label {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.18em;
  text-transform: uppercase;
  color: var(--crimson);
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 10px;
}
.section-label::before {
  content: '';
  width: 28px;
  height: 2px;
  background: var(--crimson);
  border-radius: 2px;
}
.section-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(32px, 4vw, 50px);
  font-weight: 700;
  color: var(--ink);
  line-height: 1.15;
  max-width: 600px;
}
.section-desc {
  color: var(--muted);
  font-size: 16px;
  line-height: 1.8;
  max-width: 520px;
  margin-top: 16px;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  max-width: 1200px;
  margin: 0 auto;
}
.feature-card {
  background: white;
  border-radius: 20px;
  padding: 40px 36px;
  border: 1px solid var(--border);
  transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
  position: relative;
  overflow: hidden;
}
.feature-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 3px;
  background: linear-gradient(90deg, var(--crimson), var(--crimson-light));
  opacity: 0;
  transition: opacity 0.3s;
}
.feature-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 24px 60px rgba(192,18,44,0.1);
  border-color: rgba(192,18,44,0.2);
}
.feature-card:hover::before { opacity: 1; }

.feature-icon {
  width: 60px;
  height: 60px;
  background: var(--rose);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  color: var(--crimson);
  margin-bottom: 24px;
  transition: all 0.3s;
}
.feature-card:hover .feature-icon {
  background: var(--crimson);
  color: white;
  box-shadow: 0 8px 24px rgba(192,18,44,0.35);
}
.feature-title {
  font-family: 'Playfair Display', serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 10px;
}
.feature-desc {
  font-size: 14px;
  color: var(--muted);
  line-height: 1.75;
}

/* ── ABOUT ── */
#aboutSection {
  min-height: 100vh;
  padding: 120px 80px;
  background: white;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}
.about-image-wrap {
  position: relative;
}
.about-image-wrap img {
  width: 100%;
  height: 540px;
  object-fit: cover;
  border-radius: 24px;
  display: block;
}
.about-image-accent {
  position: absolute;
  bottom: -28px;
  right: -28px;
  width: 200px;
  height: 200px;
  background: var(--rose);
  border-radius: 20px;
  z-index: -1;
}
.about-badge {
  position: absolute;
  bottom: 28px;
  left: -28px;
  background: white;
  border-radius: 16px;
  padding: 20px 24px;
  box-shadow: 0 12px 40px rgba(0,0,0,0.12);
  display: flex;
  align-items: center;
  gap: 14px;
}
.about-badge-icon {
  width: 48px;
  height: 48px;
  background: var(--crimson);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 20px;
}
.about-badge-num {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 700;
  color: var(--ink);
  line-height: 1;
}
.about-badge-label {
  font-size: 12px;
  color: var(--muted);
  font-weight: 500;
}

.about-text { padding: 20px 0; }
.about-features {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin: 36px 0;
}
.about-feature-item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
}
.about-check {
  width: 24px;
  height: 24px;
  background: var(--rose);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--crimson);
  font-size: 11px;
  flex-shrink: 0;
  margin-top: 1px;
}
.about-feature-text {
  font-size: 14px;
  color: var(--slate);
  font-weight: 500;
  line-height: 1.5;
}

/* ── SERVICES ── */
#servicesSection {
  min-height: 100vh;
  padding: 120px 80px;
  background: var(--pearl);
}
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  max-width: 1200px;
  margin: 0 auto;
}
.service-card {
  background: white;
  border-radius: 20px;
  padding: 44px 36px;
  border: 1px solid var(--border);
  position: relative;
  overflow: hidden;
  transition: all 0.35s ease;
  group: true;
}
.service-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 60px rgba(192,18,44,0.12);
}
.service-number {
  font-family: 'Playfair Display', serif;
  font-size: 64px;
  font-weight: 900;
  color: var(--rose);
  line-height: 1;
  position: absolute;
  top: 20px;
  right: 28px;
  transition: color 0.3s;
}
.service-card:hover .service-number { color: rgba(192,18,44,0.1); }
.service-icon {
  width: 64px;
  height: 64px;
  background: var(--rose);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  color: var(--crimson);
  margin-bottom: 28px;
  transition: all 0.3s;
}
.service-card:hover .service-icon {
  background: var(--crimson);
  color: white;
  box-shadow: 0 8px 28px rgba(192,18,44,0.38);
}
.service-title {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 12px;
}
.service-desc {
  font-size: 14px;
  color: var(--muted);
  line-height: 1.8;
  margin-bottom: 28px;
}
.service-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: var(--crimson);
  text-decoration: none;
  letter-spacing: 0.02em;
  cursor: pointer;
  border: none;
  background: none;
  transition: gap 0.2s;
}
.service-link:hover { gap: 14px; }


.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { margin-bottom: 20px; }
.form-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--muted);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  display: block;
  margin-bottom: 8px;
}
.form-input {
  width: 100%;
  padding: 13px 16px;
  border: 1.5px solid #e8e8ef;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: var(--ink);
  transition: border-color 0.2s;
  outline: none;
  background: var(--pearl);
}
.form-input:focus {
  border-color: var(--crimson);
  background: white;
}
textarea.form-input { resize: none; height: 110px; }
.form-btn {
  width: 100%;
  padding: 15px;
  background: var(--crimson);
  color: white;
  border: none;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  letter-spacing: 0.02em;
  box-shadow: 0 6px 24px rgba(192,18,44,0.35);
}
.form-btn:hover {
  background: var(--crimson-light);
  transform: translateY(-1px);
  box-shadow: 0 10px 32px rgba(192,18,44,0.45);
}

/* ── FOOTER ── */
footer {
  background: #080508;
  padding: 40px 80px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid rgba(255,255,255,0.05);
}
.footer-copy {
  font-size: 13px;
  color: rgba(255,255,255,0.3);
}
.footer-copy span { color: var(--crimson-light); }
.footer-links {
  display: flex;
  gap: 28px;
}
.footer-links a {
  font-size: 13px;
  color: rgba(255,255,255,0.35);
  text-decoration: none;
  transition: color 0.2s;
}
.footer-links a:hover { color: white; }

/* ── ABOUT ── */
.about-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}
.about-image-wrap { position: relative; }
.about-image-wrap img {
  width: 100%;
  height: 540px;
  object-fit: cover;
  border-radius: 24px;
  display: block;
}
.about-image-accent {
  position: absolute;
  bottom: -28px;
  right: -28px;
  width: 200px;
  height: 200px;
  background: var(--rose);
  border-radius: 20px;
  z-index: -1;
}
.about-badge {
  position: absolute;
  bottom: 28px;
  left: -28px;
  background: white;
  border-radius: 16px;
  padding: 20px 24px;
  box-shadow: 0 12px 40px rgba(0,0,0,0.12);
  display: flex;
  align-items: center;
  gap: 14px;
}
.about-badge-icon {
  width: 48px;
  height: 48px;
  background: var(--crimson);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 20px;
}
.about-badge-num {
  font-family: 'Playfair Display', serif;
  font-size: 26px;
  font-weight: 700;
  color: var(--ink);
  line-height: 1;
}
.about-badge-label { font-size: 12px; color: var(--muted); font-weight: 500; }
.about-text { padding: 20px 0; }
.about-features {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
  margin: 36px 0;
}
.about-feature-item { display: flex; align-items: flex-start; gap: 12px; }
.about-check {
  width: 24px;
  height: 24px;
  background: var(--rose);
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--crimson);
  font-size: 11px;
  flex-shrink: 0;
  margin-top: 1px;
}
.about-feature-text { font-size: 14px; color: var(--slate); font-weight: 500; line-height: 1.5; }

/* ── SERVICES ── */
.services-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  max-width: 1200px;
  margin: 0 auto;
}
.service-card {
  background: white;
  border-radius: 20px;
  padding: 44px 36px;
  border: 1px solid var(--border);
  position: relative;
  overflow: hidden;
  transition: all 0.35s ease;
}
.service-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 20px 60px rgba(192,18,44,0.12);
}
.service-number {
  font-family: 'Playfair Display', serif;
  font-size: 64px;
  font-weight: 900;
  color: var(--rose);
  line-height: 1;
  position: absolute;
  top: 20px;
  right: 28px;
  transition: color 0.3s;
}
.service-card:hover .service-number { color: rgba(192,18,44,0.1); }
.service-icon {
  width: 64px;
  height: 64px;
  background: var(--rose);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  color: var(--crimson);
  margin-bottom: 28px;
  transition: all 0.3s;
}
.service-card:hover .service-icon {
  background: var(--crimson);
  color: white;
  box-shadow: 0 8px 28px rgba(192,18,44,0.38);
}
.service-title {
  font-family: 'Playfair Display', serif;
  font-size: 22px;
  font-weight: 700;
  color: var(--ink);
  margin-bottom: 12px;
}
.service-desc { font-size: 14px; color: var(--muted); line-height: 1.8; margin-bottom: 28px; }
.service-link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 600;
  color: var(--crimson);
  cursor: pointer;
  border: none;
  background: none;
  transition: gap 0.2s;
  font-family: 'DM Sans', sans-serif;
}
.service-link:hover { gap: 14px; }



.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
.form-group { margin-bottom: 20px; }
.form-label {
  font-size: 12px;
  font-weight: 600;
  color: var(--muted);
  letter-spacing: 0.06em;
  text-transform: uppercase;
  display: block;
  margin-bottom: 8px;
}
.form-input {
  width: 100%;
  padding: 13px 16px;
  border: 1.5px solid #e8e8ef;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 14px;
  color: var(--ink);
  transition: border-color 0.2s;
  outline: none;
  background: var(--pearl);
}
.form-input:focus { border-color: var(--crimson); background: white; }
textarea.form-input { resize: none; height: 110px; }
.form-btn {
  width: 100%;
  padding: 15px;
  background: var(--crimson);
  color: white;
  border: none;
  border-radius: 10px;
  font-family: 'DM Sans', sans-serif;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s;
  box-shadow: 0 6px 24px rgba(192,18,44,0.35);
}
.form-btn:hover { background: var(--crimson-light); transform: translateY(-1px); }

/* ── FOOTER ── */
footer {
  background: #080508;
  padding: 40px 80px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid rgba(255,255,255,0.05);
}
.footer-copy { font-size: 13px; color: rgba(255,255,255,0.3); }
.footer-copy span { color: var(--crimson-light); }
.footer-links { display: flex; gap: 28px; }
.footer-links a { font-size: 13px; color: rgba(255,255,255,0.35); text-decoration: none; transition: color 0.2s; }
.footer-links a:hover { color: white; }

/* ── BACK TO TOP ── */
.back-top {
  position: fixed;
  bottom: 32px;
  right: 32px;
  width: 46px;
  height: 46px;
  background: var(--crimson);
  color: white;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0 6px 24px rgba(192,18,44,0.4);
  opacity: 0;
  transform: translateY(16px);
  transition: all 0.3s;
  border: none;
  z-index: 50;
}
.back-top.visible { opacity: 1; transform: translateY(0); }
.back-top:hover { background: var(--crimson-light); transform: translateY(-2px); }

/* ── MOBILE MENU ── */
.mobile-menu-btn { display: none; background: none; border: none; cursor: pointer; color: var(--ink); font-size: 20px; }

/* ── RESPONSIVE ── */
@media(max-width: 1024px) {
  nav { padding: 0 32px; }
  .hero-content { padding: 0 40px 60px; }
  #featuresSection { padding: 80px 40px; }
  .features-grid, .services-grid { grid-template-columns: repeat(2, 1fr); }
  footer { padding: 28px 40px; }
}
@media(max-width: 768px) {
  .nav-links { display: none; }
  .mobile-menu-btn { display: flex; }
  .stats-inner { grid-template-columns: repeat(2, 1fr); }
  .features-grid, .services-grid { grid-template-columns: 1fr; }
  .form-row { grid-template-columns: 1fr; }
  .about-features { grid-template-columns: 1fr; }
  .hero-content { padding: 0 24px 48px; }
  footer { flex-direction: column; gap: 16px; text-align: center; padding: 28px 24px; }
  #featuresSection { padding: 60px 24px; }

}
</style>
</head>
<body>

<!-- NAV -->
<nav id="mainNav">
  <div class="nav-logo" onclick="showHome()">
 <div class="nav-logo-icon">
  <img src="logo.png" alt="logo">
</div>
    <div>
      <div class="nav-logo-text">FIRST CRY</div>
      <span class="nav-logo-sub">Hôpital El Bouni ESH</span>
    </div>
  </div>

  <ul class="nav-links">
    <li><a class="active" onclick="showSection('home')">Accueil</a></li>
    <li><a onclick="showSection('about')">À Propos</a></li>
    <li><a onclick="showSection('services')">Services</a></li>
  
  </ul>

  <div class="nav-cta">
    <a href="login.php"><button class="btn-solid">Login</button></a>
  </div>
  <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
</nav>

<!-- HOME -->
<section id="homeSection">
  <div class="hero-slides">
    <div class="hero-slide active" style="background-image: url('image.jpg'), linear-gradient(135deg,#1a0608,#3d0b15)"></div>
    <div class="hero-slide" style="background-image: url('hopital.jpg'), linear-gradient(135deg,#0d1a2e,#1a2a4a)"></div>
    <div class="hero-slide" style="background-image: url('service.jpg'), linear-gradient(135deg,#0a1a0a,#1a3020)"></div>
  </div>
  <div class="hero-overlay"></div>

  <div class="hero-content">
    <div class="hero-tag">
      <i class="fas fa-shield-alt"></i>
      Établissement de Santé Public — Annaba, Algérie
    </div>
    <h1 class="hero-title">
      Des soins qui<br>font la <span>différence</span>
    </h1>
    <p class="hero-desc">
      Excellence médicale au service des mères et des enfants. Une équipe dédiée, des équipements modernes, un accompagnement humain.
    </p>
    <div class="hero-actions">
      <button class="hero-btn-primary" onclick="showSection('services')">
        <i class="fas fa-stethoscope"></i>
        Nos Services
      </button>
     
    </div>
  </div>

  <div class="hero-dots" id="heroDots">
    <div class="hero-dot active" onclick="goToSlide(0)"></div>
    <div class="hero-dot" onclick="goToSlide(1)"></div>
    <div class="hero-dot" onclick="goToSlide(2)"></div>
  </div>

  <div class="scroll-indicator">
    <div class="scroll-line"></div>
    <span>Défiler</span>
  </div>
</section>

<!-- STATS -->
<div class="stats-bar" id="statsSection">
  <div class="stats-inner">
    <div class="stat-item section-fade">
      <div class="stat-icon"><i class="fas fa-user-md"></i></div>
      <div>
        <div class="stat-num">120+</div>
        <div class="stat-label">Médecins spécialisés</div>
      </div>
    </div>
    <div class="stat-item section-fade" style="transition-delay:0.1s">
      <div class="stat-icon"><i class="fas fa-baby"></i></div>
      <div>
        <div class="stat-num">8 500+</div>
        <div class="stat-label">Naissances / an</div>
      </div>
    </div>
    <div class="stat-item section-fade" style="transition-delay:0.2s">
      <div class="stat-icon"><i class="fas fa-clock"></i></div>
      <div>
        <div class="stat-num">24 / 7</div>
        <div class="stat-label">Service d'urgences</div>
      </div>
    </div>
    <div class="stat-item section-fade" style="transition-delay:0.3s">
      <div class="stat-icon"><i class="fas fa-star"></i></div>
      <div>
        <div class="stat-num">25 ans</div>
        <div class="stat-label">D'expérience médicale</div>
      </div>
    </div>
  </div>
</div>

<!-- FEATURES -->
<section id="featuresSection" class="section-fade">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="section-header">
      <div class="section-label">Pourquoi nous choisir</div>
      <h2 class="section-title">Des soins d'excellence à chaque étape</h2>
      <p class="section-desc">Notre mission est d'offrir les meilleurs soins médicaux avec compassion et professionnalisme.</p>
    </div>
    <div class="features-grid">
      <div class="feature-card section-fade">
        <div class="feature-icon"><i class="fas fa-ambulance"></i></div>
        <div class="feature-title">Urgences 24h/24</div>
        <div class="feature-desc">Prise en charge immédiate 365 jours par an. Notre équipe d'urgence est toujours prête à intervenir.</div>
      </div>
      <div class="feature-card section-fade" style="transition-delay:0.1s">
        <div class="feature-icon"><i class="fas fa-user-md"></i></div>
        <div class="feature-title">Équipe Médicale</div>
        <div class="feature-desc">Plus de 120 médecins spécialisés formés dans les meilleures universités, à votre service.</div>
      </div>
      <div class="feature-card section-fade" style="transition-delay:0.2s">
        <div class="feature-icon"><i class="fas fa-microscope"></i></div>
        <div class="feature-title">Laboratoire Moderne</div>
        <div class="feature-desc">Analyses biologiques rapides et précises grâce à des équipements de dernière génération.</div>
      </div>
      <div class="feature-card section-fade" style="transition-delay:0.3s">
        <div class="feature-icon"><i class="fas fa-baby-carriage"></i></div>
        <div class="feature-title">Maternité & Néonatologie</div>
        <div class="feature-desc">Accompagnement complet de la grossesse à la naissance dans un cadre sécurisé et chaleureux.</div>
      </div>
      <div class="feature-card section-fade" style="transition-delay:0.4s">
        <div class="feature-icon"><i class="fas fa-x-ray"></i></div>
        <div class="feature-title">Imagerie Médicale</div>
        <div class="feature-desc">Radiologie, échographie, scanner — un plateau technique complet pour un diagnostic précis.</div>
      </div>
      <div class="feature-card section-fade" style="transition-delay:0.5s">
        <div class="feature-icon"><i class="fas fa-pills"></i></div>
        <div class="feature-title">Pharmacie Interne</div>
        <div class="feature-desc">Disponibilité des médicaments essentiels sur place pour un traitement immédiat et efficace.</div>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT -->
<section id="aboutSection" class="hidden" style="min-height:100vh;padding:120px 80px;background:white;display:flex;flex-direction:column;justify-content:center;">
  <div class="about-grid">
    <div class="about-image-wrap section-fade">
      <img src="image.jpg" alt="Hôpital" onerror="this.style.background='linear-gradient(135deg,#f8e8ea,#fde8ec)';this.src=''">
      <div class="about-image-accent"></div>
      <div class="about-badge">
        <div class="about-badge-icon"><i class="fas fa-award"></i></div>
        <div>
          <div class="about-badge-num">N°1</div>
          <div class="about-badge-label">Maternité — Annaba</div>
        </div>
      </div>
    </div>
    <div class="about-text section-fade" style="transition-delay:0.15s">
      <div class="section-label">À Propos de nous</div>
      <h2 class="section-title">Un hôpital au cœur de la vie</h2>
      <p class="section-desc" style="margin-top:20px">
        Fondé il y a plus de 25 ans, l'Hôpital El Bouni ESH est un établissement de santé public de référence dans la wilaya d'Annaba. Spécialisé dans la santé de la mère et de l'enfant, nous plaçons l'humain au centre de toutes nos actions.
      </p>
      <div class="about-features">
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Soins périnatalité avancés</div>
        </div>
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Bloc opératoire 24h/24</div>
        </div>
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Pédiatrie spécialisée</div>
        </div>
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Suivi grossesse complet</div>
        </div>
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Équipe sage-femme dédiée</div>
        </div>
        <div class="about-feature-item">
          <div class="about-check"><i class="fas fa-check"></i></div>
          <div class="about-feature-text">Accueil patients optimisé</div>
        </div>
      </div>
      <button class="btn-solid" onclick="showSection('services')" style="padding:14px 32px;font-size:14px">
        Découvrir nos services <i class="fas fa-arrow-right" style="margin-left:8px"></i>
      </button>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section id="servicesSection" class="hidden" style="min-height:100vh;padding:120px 80px;background:var(--pearl);">
  <div style="max-width:1200px;margin:0 auto;">
    <div class="section-header section-fade">
      <div class="section-label">Nos Services</div>
      <h2 class="section-title">Une prise en charge globale</h2>
      <p class="section-desc">Des spécialités médicales complètes pour prendre soin de vous et de votre famille.</p>
    </div>
    <div class="services-grid">
      <div class="service-card section-fade">
        <div class="service-number">01</div>
        <div class="service-icon"><i class="fas fa-ambulance"></i></div>
        <div class="service-title">Urgences</div>
        <div class="service-desc">Prise en charge immédiate des urgences médicales et obstétricales 24h/24, 7j/7.</div>
      </div>
      <div class="service-card section-fade" style="transition-delay:0.1s">
        <div class="service-number">02</div>
        <div class="service-icon"><i class="fas fa-baby"></i></div>
        <div class="service-title">Maternité</div>
        <div class="service-desc">Suivi de grossesse, accouchement et soins post-nataux dans un environnement sécurisé.</div>
      </div>
      <div class="service-card section-fade" style="transition-delay:0.2s">
        <div class="service-number">03</div>
        <div class="service-icon"><i class="fas fa-vial"></i></div>
        <div class="service-title">Laboratoire</div>
        <div class="service-desc">Analyses biologiques, hématologie, biochimie et bactériologie avec résultats rapides.</div>
      </div>
      <div class="service-card section-fade" style="transition-delay:0.3s">
        <div class="service-number">04</div>
        <div class="service-icon"><i class="fas fa-child"></i></div>
        <div class="service-title">Pédiatrie</div>
        <div class="service-desc">Consultations et hospitalisations spécialisées pour les nouveau-nés et les enfants.</div>
      </div>
      <div class="service-card section-fade" style="transition-delay:0.4s">
        <div class="service-number">05</div>
        <div class="service-icon"><i class="fas fa-x-ray"></i></div>
        <div class="service-title">Imagerie Médicale</div>
        <div class="service-desc">Échographie, radiologie numérique et examens d'imagerie pour un diagnostic précis.</div>
      </div>
      <div class="service-card section-fade" style="transition-delay:0.5s">
        <div class="service-number">06</div>
        <div class="service-icon"><i class="fas fa-procedures"></i></div>
        <div class="service-title">Chirurgie</div>
        <div class="service-desc">Bloc opératoire équipé pour les interventions gynécologiques et obstétricales urgentes.</div>
      </div>
    </div>
  </div>
</section>



<!-- FOOTER — shown on all pages -->
<footer id="mainFooter">
  <div class="footer-copy">© 2025 <span>FIRST CRY</span> — Hôpital El Bouni ESH. Tous droits réservés.</div>
  <div class="footer-links">
    <a href="#">Confidentialité</a>
    <a href="#">Mentions légales</a>
    <a href="#">Accessibilité</a>
  </div>
</footer>

<!-- BACK TO TOP -->
<button class="back-top" id="backTop" onclick="showSection('home')">
  <i class="fas fa-arrow-up"></i>
</button>

<script>
// ── SLIDE SHOW ──
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots   = document.querySelectorAll('.hero-dot');

function goToSlide(n) {
  slides[currentSlide].classList.remove('active');
  dots[currentSlide].classList.remove('active');
  currentSlide = n;
  slides[currentSlide].classList.add('active');
  dots[currentSlide].classList.add('active');
}
setInterval(() => goToSlide((currentSlide + 1) % slides.length), 4000);

// ── SECTION SWITCHING ──
const ALL_SECTIONS = ['homeSection','statsSection','featuresSection','aboutSection','servicesSection'];

const SECTION_MAP = {
  home:     ['homeSection','statsSection','featuresSection'],
  about:    ['aboutSection'],
  services: ['servicesSection'],

};

function showHome() { showSection('home'); }

function showSection(name) {
  // Hide all
  ALL_SECTIONS.forEach(id => document.getElementById(id)?.classList.add('hidden'));

  // Show footer on every page
  document.getElementById('mainFooter').style.display = 'flex';

  // Show target sections
  (SECTION_MAP[name] || []).forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.remove('hidden');
    setTimeout(() => triggerFade(el), 60);
  });

  // Update nav active link
  document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
  const navOrder = ['home','about','services'];
  const idx = navOrder.indexOf(name);
  const links = document.querySelectorAll('.nav-links a');
  if (links[idx]) links[idx].classList.add('active');

  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function triggerFade(section) {
  if (!section) return;
  section.querySelectorAll('.section-fade').forEach((el, i) => {
    setTimeout(() => el.classList.add('visible'), i * 70);
  });
}

// ── SCROLL ──
window.addEventListener('scroll', () => {
  document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 20);
  document.getElementById('backTop').classList.toggle('visible', window.scrollY > 400);
  document.querySelectorAll('.section-fade:not(.visible)').forEach(el => {
    if (el.getBoundingClientRect().top < window.innerHeight - 60) el.classList.add('visible');
  });
});

// Init home on load
setTimeout(() => triggerFade(document), 200);
</script>
</body>
</html>


