// shared.jsx — primitives compartilhadas
// Logo Innovate, bandeiras dos times, header app, etc

// ============================================================
// LOGO INNOVATE — recriada como SVG para ficar nítida em qualquer tamanho.
// Quando exibido em fundo escuro, usa variant="dark"; no fundo claro use "light".
// ============================================================
function InnovateLogo({ size = 36, variant = 'dark', showAutomacao = false }) {
  const ink = variant === 'dark' ? '#FFFFFF' : '#0A1131';
  const ringColor = '#1A8FB8'; // teal do logo original
  return (
    <div style={{ display: 'inline-flex', alignItems: 'center', gap: 10 }}>
      {/* mini bandeira ondulando (estilizada) */}
      <svg width={size * 1.05} height={size} viewBox="0 0 42 40" style={{ flexShrink: 0 }}>
        <defs>
          <linearGradient id="flagG" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stopColor="#1FD66B" />
            <stop offset="100%" stopColor="#006B28" />
          </linearGradient>
        </defs>
        {/* mastro */}
        <rect x="2" y="3" width="2" height="34" rx="1" fill={ink} opacity=".85" />
        {/* pano da bandeira (com ondulação) */}
        <path d="M5 5 Q 18 1, 32 6 T 40 8 L 40 24 Q 27 28, 14 23 T 5 22 Z" fill="url(#flagG)" />
        {/* losango */}
        <path d="M22.5 8 L 33 14 L 22.5 20 L 14 14 Z" fill="#FEDF00" />
        {/* círculo azul */}
        <circle cx="22.5" cy="14" r="3.3" fill="#002776" />
      </svg>
      <div style={{ display: 'flex', flexDirection: 'column', lineHeight: 1 }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 4 }}>
          {/* in dentro de círculo */}
          <span style={{
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            width: size * 0.72, height: size * 0.72,
            borderRadius: '50%',
            border: `2px solid ${ringColor}`,
            color: ringColor,
            fontFamily: 'Inter',
            fontWeight: 800,
            fontSize: size * 0.36,
            fontStyle: 'italic',
            letterSpacing: '-0.03em',
            paddingBottom: 1,
          }}>in</span>
          <span style={{
            fontFamily: 'Inter',
            fontWeight: 800,
            fontSize: size * 0.82,
            color: ink,
            letterSpacing: '-0.04em',
          }}>innovate</span>
        </div>
        {showAutomacao && (
          <span style={{
            fontFamily: 'Inter',
            fontWeight: 600,
            fontSize: size * 0.22,
            color: ink,
            opacity: .85,
            letterSpacing: '.42em',
            marginTop: 4,
            marginLeft: size * 0.78,
          }}>AUTOMAÇÃO</span>
        )}
      </div>
    </div>
  );
}

// ============================================================
// BANDEIRAS — SVGs compactos
// ============================================================
function FlagBRA({ size = 56 }) {
  const h = size * 0.7;
  return (
    <svg width={size} height={h} viewBox="0 0 80 56" style={{ borderRadius: 6, boxShadow: '0 6px 18px rgba(0,0,0,0.35)' }}>
      <rect width="80" height="56" fill="#009C3B" />
      <path d="M40 6 L 74 28 L 40 50 L 6 28 Z" fill="#FEDF00" />
      <circle cx="40" cy="28" r="11" fill="#002776" />
      <path d="M30 26 Q 40 22, 50 26" stroke="#fff" strokeWidth="1.2" fill="none" />
    </svg>
  );
}
function FlagMAR({ size = 56 }) {
  const h = size * 0.7;
  return (
    <svg width={size} height={h} viewBox="0 0 80 56" style={{ borderRadius: 6, boxShadow: '0 6px 18px rgba(0,0,0,0.35)' }}>
      <rect width="80" height="56" fill="#C1272D" />
      <path d="M40 18 L 43.5 28 L 54 28 L 45.5 34 L 49 44 L 40 38 L 31 44 L 34.5 34 L 26 28 L 36.5 28 Z"
            fill="none" stroke="#006233" strokeWidth="1.6" />
    </svg>
  );
}
function FlagHAI({ size = 56 }) {
  const h = size * 0.7;
  return (
    <svg width={size} height={h} viewBox="0 0 80 56" style={{ borderRadius: 6, boxShadow: '0 6px 18px rgba(0,0,0,0.35)' }}>
      <rect width="80" height="28" fill="#00209F" />
      <rect y="28" width="80" height="28" fill="#D21034" />
      <rect x="32" y="20" width="16" height="16" fill="#fff" />
      <rect x="38" y="24" width="4" height="8" fill="#00209F" />
    </svg>
  );
}
function FlagSCO({ size = 56 }) {
  const h = size * 0.7;
  return (
    <svg width={size} height={h} viewBox="0 0 80 56" style={{ borderRadius: 6, boxShadow: '0 6px 18px rgba(0,0,0,0.35)' }}>
      <rect width="80" height="56" fill="#0065BD" />
      <path d="M0 0 L 80 56 M 80 0 L 0 56" stroke="#fff" strokeWidth="9" />
    </svg>
  );
}
function FlagSUI({ size = 56 }) {
  const h = size * 0.7;
  return (
    <svg width={size} height={h} viewBox="0 0 80 56" style={{ borderRadius: 6, boxShadow: '0 6px 18px rgba(0,0,0,0.35)' }}>
      <rect width="80" height="56" fill="#D52B1E" />
      <rect x="34" y="14" width="12" height="28" fill="#fff" />
      <rect x="26" y="22" width="28" height="12" fill="#fff" />
    </svg>
  );
}

const FLAGS = { BRA: FlagBRA, MAR: FlagMAR, HAI: FlagHAI, SCO: FlagSCO, SUI: FlagSUI };

function Flag({ code, size = 56 }) {
  const C = FLAGS[code] || FlagBRA;
  return <C size={size} />;
}

// Nome cheio dos times pra exibição
const TEAM_NAMES = {
  BRA: 'Brasil',
  MAR: 'Marrocos',
  HAI: 'Haiti',
  SCO: 'Escócia',
  SUI: 'Suíça',
};

// ============================================================
// BG DECORATIVO BRASIL — losango sutil + grão
// Usar como first child de um container relativo
// ============================================================
function BrazilBgDeco({ intensity = 1 }) {
  return (
    <>
      {/* losango gigante sutil ao fundo (referência à bandeira) */}
      <svg
        width="100%" height="100%"
        viewBox="0 0 1440 900"
        preserveAspectRatio="xMidYMid slice"
        style={{ position: 'absolute', inset: 0, pointerEvents: 'none', zIndex: 0 }}
      >
        <defs>
          <linearGradient id="dia" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stopColor="#FEDF00" stopOpacity={0.08 * intensity} />
            <stop offset="100%" stopColor="#FEDF00" stopOpacity={0.0} />
          </linearGradient>
          <radialGradient id="navyglow" cx="0.5" cy="0">
            <stop offset="0%" stopColor="#002776" stopOpacity={0.55 * intensity} />
            <stop offset="100%" stopColor="#002776" stopOpacity={0} />
          </radialGradient>
          <linearGradient id="greenStripe" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stopColor="#1FD66B" stopOpacity={0} />
            <stop offset="50%" stopColor="#1FD66B" stopOpacity={0.45 * intensity} />
            <stop offset="100%" stopColor="#1FD66B" stopOpacity={0} />
          </linearGradient>
        </defs>
        {/* glow azul no topo */}
        <rect x="0" y="0" width="1440" height="900" fill="url(#navyglow)" />
        {/* losango */}
        <path d="M 720 90 L 1380 450 L 720 810 L 60 450 Z" stroke="url(#dia)" strokeWidth="1.2" fill="none" />
        <path d="M 720 220 L 1240 450 L 720 680 L 200 450 Z" stroke="url(#dia)" strokeWidth="0.8" fill="none" opacity=".5" />
        {/* faixa verde diagonal sutil */}
        <rect x="-100" y="780" width="1640" height="2" fill="url(#greenStripe)" />
      </svg>
      {/* grain */}
      <div style={{
        position: 'absolute', inset: 0, pointerEvents: 'none', zIndex: 0,
        opacity: 0.08, mixBlendMode: 'overlay',
        backgroundImage: "url(\"data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='240' height='240'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='2' stitchTiles='stitch'/><feColorMatrix values='0 0 0 0 1  0 0 0 0 1  0 0 0 0 1  0 0 0 0.6 0'/></filter><rect width='100%25' height='100%25' filter='url(%23n)'/></svg>\")",
      }} />
    </>
  );
}

// ============================================================
// TOP NAV — usado em Dashboard, Palpite, Admin
// ============================================================
function TopNav({ active = 'dashboard', user = 'Lucas Pereira', userInitials = 'LP', isAdmin = false }) {
  const items = [
    { key: 'dashboard', label: 'Dashboard', icon: 'dashboard' },
    { key: 'jogos', label: 'Jogos', icon: 'sports_soccer' },
    { key: 'ranking', label: 'Ranking', icon: 'emoji_events' },
    { key: 'regras', label: 'Regras', icon: 'menu_book' },
  ];
  if (isAdmin) items.push({ key: 'admin', label: 'Admin', icon: 'settings' });

  return (
    <header style={{
      position: 'relative', zIndex: 5,
      height: 72,
      display: 'flex', alignItems: 'center',
      padding: '0 32px',
      borderBottom: '1px solid var(--border-soft)',
      background: 'rgba(5,11,31,0.65)',
      backdropFilter: 'blur(14px)',
      gap: 32,
    }}>
      {/* Brand */}
      <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
        <InnovateLogo size={26} variant="dark" />
        <div style={{
          width: 1, height: 22,
          background: 'var(--border-strong)',
          marginInline: 6,
        }} />
        <div style={{ display: 'flex', flexDirection: 'column', lineHeight: 1.05 }}>
          <span style={{ font: '700 13px/1 Inter', letterSpacing: '.04em', textTransform: 'uppercase' }}>
            Bolão Innovate
          </span>
          <span style={{ font: '500 10.5px/1 Inter', color: 'var(--fg-muted)', letterSpacing: '.22em', marginTop: 4 }}>
            COPA DO MUNDO 2026
          </span>
        </div>
      </div>

      {/* Nav */}
      <nav style={{ display: 'flex', gap: 4, marginLeft: 24 }}>
        {items.map(it => {
          const isActive = it.key === active;
          return (
            <a key={it.key} style={{
              display: 'inline-flex', alignItems: 'center', gap: 8,
              padding: '0 14px', height: 36,
              borderRadius: 'var(--r-pill)',
              font: '500 13.5px/1 Inter',
              color: isActive ? '#fff' : 'var(--fg-secondary)',
              background: isActive ? 'rgba(255,255,255,0.08)' : 'transparent',
              border: isActive ? '1px solid var(--border-medium)' : '1px solid transparent',
              cursor: 'pointer',
            }}>
              <span className="material-symbols-outlined" style={{
                fontSize: 18,
                color: isActive ? 'var(--br-yellow)' : 'var(--fg-muted)',
              }}>{it.icon}</span>
              {it.label}
            </a>
          );
        })}
      </nav>

      <div style={{ flex: 1 }} />

      {/* Live indicator */}
      <div style={{
        display: 'inline-flex', alignItems: 'center', gap: 8,
        padding: '0 12px', height: 32,
        borderRadius: 'var(--r-pill)',
        border: '1px solid rgba(31,214,107,0.30)',
        background: 'rgba(31,214,107,0.08)',
        font: '600 11px/1 Inter', letterSpacing: '.08em', textTransform: 'uppercase',
        color: '#62F49B',
      }}>
        <span style={{ width: 7, height: 7, borderRadius: 99, background: '#1FD66B', boxShadow: '0 0 8px #1FD66B' }} />
        Bolão Ativo
      </div>

      {/* User */}
      <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
        <div style={{
          width: 38, height: 38,
          borderRadius: '50%',
          background: 'linear-gradient(135deg, #1FD66B 0%, #002776 100%)',
          display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          font: '700 13px/1 Inter', color: '#fff',
          border: '1px solid var(--border-medium)',
        }}>{userInitials}</div>
        <div style={{ display: 'flex', flexDirection: 'column', lineHeight: 1.1 }}>
          <span style={{ font: '600 13px/1 Inter' }}>{user}</span>
          <span style={{ font: '500 11px/1 Inter', color: 'var(--fg-muted)', marginTop: 3 }}>
            {isAdmin ? 'Admin' : 'Participante #07'}
          </span>
        </div>
      </div>
    </header>
  );
}

// Dataset compartilhado entre Dashboard e outras telas
const PARTICIPANTS = [
  { i: 'CM', name: 'Camila Moraes',      total: 28, exato: 2, ganhador: 4, parcial: 6, palpite: [2,1] },
  { i: 'BR', name: 'Bruno Ramires',      total: 26, exato: 2, ganhador: 4, parcial: 4, palpite: [2,0] },
  { i: 'LP', name: 'Lucas Pereira',      total: 25, exato: 1, ganhador: 5, parcial: 5, palpite: [3,1], isMe: true },
  { i: 'JR', name: 'Júlia Ribeiro',      total: 24, exato: 1, ganhador: 5, parcial: 4, palpite: [2,0] },
  { i: 'RT', name: 'Rafael Tavares',     total: 22, exato: 1, ganhador: 4, parcial: 4, palpite: [3,0] },
  { i: 'AS', name: 'Ana Sousa',          total: 21, exato: 0, ganhador: 5, parcial: 6, palpite: [1,0] },
  { i: 'PC', name: 'Pedro Cunha',        total: 20, exato: 1, ganhador: 3, parcial: 5, palpite: [2,1] },
  { i: 'MG', name: 'Marina Gomes',       total: 19, exato: 0, ganhador: 4, parcial: 7, palpite: [2,0] },
  { i: 'GF', name: 'Gustavo Faria',      total: 18, exato: 1, ganhador: 3, parcial: 3, palpite: [4,1] },
  { i: 'IB', name: 'Isabela Bento',      total: 17, exato: 0, ganhador: 4, parcial: 5, palpite: [2,0] },
  { i: 'TM', name: 'Tiago Martins',      total: 16, exato: 1, ganhador: 2, parcial: 4, palpite: [1,1] },
  { i: 'LV', name: 'Larissa Veloso',     total: 15, exato: 0, ganhador: 3, parcial: 6, palpite: [3,2] },
  { i: 'DC', name: 'Diego Carvalho',     total: 14, exato: 0, ganhador: 3, parcial: 5, palpite: [2,1] },
  { i: 'NS', name: 'Natália Souto',      total: 13, exato: 0, ganhador: 3, parcial: 4, palpite: [1,0] },
  { i: 'FE', name: 'Felipe Esteves',     total: 12, exato: 0, ganhador: 2, parcial: 6, palpite: [2,2] },
  { i: 'RR', name: 'Renata Rocha',       total: 11, exato: 0, ganhador: 2, parcial: 5, palpite: [3,0] },
  { i: 'HB', name: 'Henrique Bandeira',  total: 10, exato: 0, ganhador: 2, parcial: 4, palpite: [2,1] },
  { i: 'SM', name: 'Sofia Maron',        total:  9, exato: 0, ganhador: 1, parcial: 6, palpite: [1,1] },
  { i: 'EO', name: 'Eduardo Oliveira',   total:  7, exato: 0, ganhador: 1, parcial: 4, palpite: [0,1] },
  { i: 'VS', name: 'Vinícius Salles',    total:  5, exato: 0, ganhador: 0, parcial: 5, palpite: [1,2] },
];

// expor globais (cada arquivo Babel tem seu próprio escopo)
Object.assign(window, {
  InnovateLogo, Flag, FLAGS, TEAM_NAMES, BrazilBgDeco, TopNav, PARTICIPANTS,
});
