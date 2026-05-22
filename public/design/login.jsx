// login.jsx
function LoginScreen() {
  return (
    <div className="app-root" style={{
      position: 'relative',
      background: 'var(--grad-hero)'
    }}>
      <BrazilBgDeco intensity={1.1} />

      {/* Faixa decorativa do estádio (linhas de campo) */}
      <svg width="100%" height="100%" viewBox="0 0 1280 800" preserveAspectRatio="xMidYMid slice"
      style={{ position: 'absolute', inset: 0, pointerEvents: 'none', opacity: .5, zIndex: 1 }}>
        <defs>
          <radialGradient id="bglogin" cx="0.5" cy="0.5">
            <stop offset="0%" stopColor="rgba(0,156,59,0.18)" />
            <stop offset="100%" stopColor="rgba(0,156,59,0)" />
          </radialGradient>
        </defs>
        <ellipse cx="640" cy="380" rx="520" ry="320" fill="url(#bglogin)" />
        {/* círculo central do campo */}
        <circle cx="640" cy="380" r="240" stroke="rgba(255,255,255,0.06)" strokeWidth="1" fill="none" />
        <circle cx="640" cy="380" r="2.5" fill="rgba(254,223,0,0.6)" />
      </svg>

      {/* Card de login */}
      <div style={{
        position: 'relative', zIndex: 5,
        height: '100%',
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        padding: 40
      }}>
        <div className="card" style={{
          width: 460,
          padding: '44px 44px 36px',
          background: 'rgba(10,17,49,0.85)',
          backdropFilter: 'blur(20px)',
          border: '1px solid rgba(255,255,255,0.10)',
          borderRadius: 'var(--r-2xl)',
          boxShadow: '0 30px 80px rgba(0,0,0,0.55), 0 0 0 1px rgba(255,255,255,0.04) inset'
        }}>
          {/* selo decorativo no topo */}
          <div style={{
            display: 'flex', flexDirection: 'column', alignItems: 'center',
            gap: 20, marginBottom: 32
          }}>
            <div style={{
              padding: '14px 22px',
              borderRadius: 'var(--r-xl)',
              background: '#fff',
              border: '1px solid rgba(255,255,255,0.15)',
              boxShadow: '0 8px 30px rgba(0,0,0,0.45)'
            }}>
              <InnovateLogo size={32} variant="light" showAutomacao={true} />
            </div>
            <div style={{ textAlign: 'center' }}>
              <div style={{
                display: 'inline-flex', gap: 8, alignItems: 'center',
                padding: '4px 12px',
                borderRadius: 'var(--r-pill)',
                background: 'rgba(254,223,0,0.10)',
                border: '1px solid rgba(254,223,0,0.30)',
                font: '700 10.5px/1 Inter',
                letterSpacing: '.18em',
                textTransform: 'uppercase',
                color: 'var(--br-yellow)',
                marginBottom: 16
              }}>
                <span className="material-symbols-outlined" style={{ fontSize: 13 }}>workspace_premium</span>
                Edição Copa do Mundo 2026
              </div>
              <h1 style={{
                margin: 0,
                font: '800 30px/1.1 Inter',
                letterSpacing: '-0.025em',
                color: '#fff'
              }}>
                Bolão Innovate
              </h1>
              <p style={{
                margin: '10px 0 0',
                font: '500 14px/1.5 Inter',
                color: 'var(--fg-muted)',
                maxWidth: 320,
                marginInline: 'auto'
              }}>
                Entre com seu e-mail corporativo para registrar seus palpites dos jogos do Brasil.
              </p>
            </div>
          </div>

          {/* form */}
          <div style={{ display: 'flex', flexDirection: 'column', gap: 16 }}>
            <div>
              <label className="field-label">E-mail corporativo</label>
              <div style={{ position: 'relative' }}>
                <span className="material-symbols-outlined" style={{
                  position: 'absolute', left: 16, top: '50%', transform: 'translateY(-50%)',
                  color: 'var(--fg-muted)', fontSize: 20
                }}>mail</span>
                <input className="input" defaultValue="lucas.pereira@innovate.com.br" />
              </div>
            </div>

            <div>
              <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 8 }}>
                <label className="field-label" style={{ margin: 0 }}>Senha</label>
                <a style={{ font: '600 11.5px/1 Inter', color: 'var(--br-yellow)', cursor: 'pointer' }}>
                  Esqueci minha senha
                </a>
              </div>
              <div style={{ position: 'relative' }}>
                <span className="material-symbols-outlined" style={{
                  position: 'absolute', left: 16, top: '50%', transform: 'translateY(-50%)',
                  color: 'var(--fg-muted)', fontSize: 20
                }}>lock</span>
                <input className="input" type="password" defaultValue="••••••••••" />
                <span className="material-symbols-outlined" style={{
                  position: 'absolute', right: 16, top: '50%', transform: 'translateY(-50%)',
                  color: 'var(--fg-muted)', fontSize: 20, cursor: 'pointer'
                }}>visibility_off</span>
              </div>
            </div>

            <label style={{
              display: 'inline-flex', alignItems: 'center', gap: 10,
              font: '500 13px/1 Inter', color: 'var(--fg-secondary)',
              cursor: 'pointer', marginTop: 4
            }}>
              <span style={{
                width: 18, height: 18,
                borderRadius: 5,
                background: 'var(--br-green)',
                border: '1px solid var(--br-green-bright)',
                display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                boxShadow: '0 0 0 3px rgba(31,214,107,0.10)'
              }}>
                <span className="material-symbols-outlined" style={{ fontSize: 14, color: '#fff', fontWeight: 800 }}>check</span>
              </span>
              Manter conectado neste dispositivo
            </label>

            <button className="btn-primary" style={{ height: 54, marginTop: 8, fontSize: 15 }}>
              Entrar
              <span className="material-symbols-outlined" style={{ fontSize: 18 }}>arrow_forward</span>
            </button>

            <div style={{
              marginTop: 14, padding: '14px 16px',
              borderRadius: 'var(--r-md)',
              background: 'rgba(0,39,118,0.35)',
              border: '1px solid rgba(91,180,255,0.25)',
              display: 'flex', alignItems: 'flex-start', gap: 10
            }}>
              <span className="material-symbols-outlined" style={{
                fontSize: 18, color: '#8EA9FF', marginTop: 1
              }}>info</span>
              <div style={{ font: '500 12.5px/1.5 Inter', color: 'var(--fg-secondary)' }}>
                Apenas colaboradores Innovate com e-mail <strong style={{ color: '#fff' }}>@innovate.com.br</strong> podem participar.
              </div>
            </div>
          </div>
        </div>

        {/* footer ribbon */}
        <div style={{
          position: 'absolute', bottom: 24, left: 0, right: 0,
          display: 'flex', justifyContent: 'center',
          font: '500 11px/1 Inter', color: 'var(--fg-faint)',
          letterSpacing: '.16em', textTransform: 'uppercase'
        }}>
          <span style={{ display: 'inline-flex', alignItems: 'center', gap: 14 }}>
            <span>Powered by Innovate Automação</span>
            <span style={{ width: 3, height: 3, borderRadius: 99, background: 'var(--fg-faint)' }} />
            <span>12 jogos</span>
            <span style={{ width: 3, height: 3, borderRadius: 99, background: 'var(--fg-faint)' }} />
            <span>Prêmio R$ 200 + Day Off</span>
          </span>
        </div>
      </div>
    </div>);

}

Object.assign(window, { LoginScreen });