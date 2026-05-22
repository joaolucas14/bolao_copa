// palpite.jsx — tela de palpite (3 estados como artboards separados)

function PalpiteHeader() {
  return (
    <div className="card" style={{
      padding: '22px 28px',
      borderRadius: 'var(--r-2xl)',
      display: 'flex', alignItems: 'center', justifyContent: 'space-between',
      gap: 24,
    }}>
      <div style={{ display: 'flex', alignItems: 'center', gap: 18 }}>
        <button className="btn-ghost" style={{ height: 38, paddingInline: 12 }}>
          <span className="material-symbols-outlined" style={{ fontSize: 18 }}>arrow_back</span>
          Voltar
        </button>
        <div style={{ height: 30, width: 1, background: 'var(--border-medium)' }} />
        <div style={{ display: 'flex', alignItems: 'center', gap: 16 }}>
          <Flag code="BRA" size={48} />
          <div>
            <div style={{ font: '700 18px/1 Inter', color: '#fff' }}>Brasil × Marrocos</div>
            <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
              Estádio Azteca, Cidade do México
            </div>
          </div>
          <Flag code="MAR" size={48} />
        </div>
      </div>

      <div style={{ display: 'flex', gap: 10 }}>
        <span className="chip yellow">
          <span className="material-symbols-outlined" style={{ fontSize: 13 }}>scoreboard</span>
          Fase de Grupos · Grupo G
        </span>
        <span className="chip">
          <span className="material-symbols-outlined" style={{ fontSize: 13 }}>event</span>
          15 jun · 16:00 BRT
        </span>
        <span className="chip red">
          <span className="material-symbols-outlined" style={{ fontSize: 13 }}>timer</span>
          Fecha em 3d 14h 22m
        </span>
      </div>
    </div>
  );
}

function ScoreStepper({ value, team, color, side }) {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 24 }}>
      {/* time identity */}
      <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 12 }}>
        <Flag code={team} size={88} />
        <div style={{ textAlign: 'center' }}>
          <div style={{ font: '900 38px/1 Inter', letterSpacing: '-0.04em', color: '#fff' }}>{team}</div>
          <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 6, letterSpacing: '.10em' }}>
            {TEAM_NAMES[team].toUpperCase()}
          </div>
        </div>
      </div>

      {/* scoreboard frame */}
      <div style={{
        position: 'relative',
        width: 220, height: 240,
        borderRadius: 24,
        background: 'linear-gradient(180deg, #04081C 0%, #0A1131 100%)',
        border: '2px solid rgba(255,255,255,0.10)',
        boxShadow: `
          0 0 0 1px rgba(255,255,255,0.02),
          0 30px 60px rgba(0,0,0,0.55),
          0 0 80px ${color}22,
          inset 0 2px 0 rgba(255,255,255,0.06),
          inset 0 -3px 0 rgba(0,0,0,0.5)
        `,
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        overflow: 'hidden',
      }}>
        {/* scanlines stadium board feel */}
        <div style={{
          position: 'absolute', inset: 0,
          backgroundImage: 'repeating-linear-gradient(0deg, rgba(255,255,255,0.025) 0 1px, transparent 1px 4px)',
          pointerEvents: 'none',
        }} />
        {/* canto chips */}
        <div style={{
          position: 'absolute', top: 12, left: 12,
          font: '700 10px/1 Inter', letterSpacing: '.14em', textTransform: 'uppercase',
          color: 'var(--fg-muted)',
        }}>{side === 'home' ? 'CASA' : 'VISITANTE'}</div>
        <div style={{
          position: 'absolute', top: 12, right: 12,
          width: 8, height: 8, borderRadius: 99,
          background: color,
          boxShadow: `0 0 14px ${color}`,
        }} />

        <div className="score-digit" style={{ fontSize: 180, color }}>
          {value}
        </div>
      </div>

      {/* stepper */}
      <div style={{ display: 'flex', gap: 12 }}>
        <button style={{
          width: 56, height: 56, borderRadius: 'var(--r-pill)',
          background: 'rgba(255,255,255,0.04)',
          border: '1px solid var(--border-medium)',
          color: '#fff',
          cursor: 'pointer',
          display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          transition: 'all .2s var(--ease)',
        }}>
          <span className="material-symbols-outlined" style={{ fontSize: 26 }}>remove</span>
        </button>
        <button style={{
          width: 56, height: 56, borderRadius: 'var(--r-pill)',
          background: 'var(--grad-green-flat)',
          border: '1px solid rgba(31,214,107,0.50)',
          color: '#fff',
          cursor: 'pointer',
          display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          boxShadow: '0 8px 20px rgba(0,156,59,0.40), 0 1px 0 rgba(255,255,255,0.25) inset',
        }}>
          <span className="material-symbols-outlined" style={{ fontSize: 26 }}>add</span>
        </button>
      </div>
    </div>
  );
}

function PalpiteFormBody({ showModal = false }) {
  return (
    <>
      <div className="card" style={{
        padding: '40px 48px 48px',
        borderRadius: 'var(--r-2xl)',
        background: 'linear-gradient(180deg, #0E1A4A 0%, #07102C 100%)',
        position: 'relative',
        overflow: 'hidden',
      }}>
        {/* fundo: linha do meio-campo */}
        <svg width="100%" height="100%" viewBox="0 0 1180 520" preserveAspectRatio="none"
             style={{ position: 'absolute', inset: 0, opacity: .5, pointerEvents: 'none' }}>
          <line x1="590" y1="40" x2="590" y2="480" stroke="rgba(255,255,255,0.06)" strokeWidth="1" />
          <circle cx="590" cy="260" r="80" stroke="rgba(255,255,255,0.06)" strokeWidth="1" fill="none" />
        </svg>

        <div style={{
          textAlign: 'center', marginBottom: 30, position: 'relative',
        }}>
          <div style={{
            display: 'inline-flex', gap: 8, alignItems: 'center',
            padding: '6px 14px',
            borderRadius: 'var(--r-pill)',
            background: 'rgba(254,223,0,0.10)',
            border: '1px solid rgba(254,223,0,0.30)',
            font: '700 11px/1 Inter', letterSpacing: '.16em', textTransform: 'uppercase',
            color: 'var(--br-yellow)',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 14 }}>edit</span>
            Registre seu palpite
          </div>
          <h2 style={{
            margin: '14px 0 6px',
            font: '800 28px/1.15 Inter', letterSpacing: '-0.02em', color: '#fff',
          }}>
            Qual vai ser o placar?
          </h2>
          <p style={{
            margin: 0, font: '500 13.5px/1.5 Inter', color: 'var(--fg-muted)',
            maxWidth: 480, marginInline: 'auto',
          }}>
            Use os botões abaixo de cada time pra ajustar o placar.<br />
            Após a confirmação, o palpite <strong style={{ color: '#fff' }}>não pode ser alterado</strong>.
          </p>
        </div>

        {/* scoreboard */}
        <div style={{
          display: 'grid', gridTemplateColumns: '1fr auto 1fr',
          gap: 32, alignItems: 'center',
          padding: '8px 40px 0',
          position: 'relative',
        }}>
          <ScoreStepper value={3} team="BRA" color="#1FD66B" side="home" />
          <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 14 }}>
            <span style={{
              font: '900 60px/1 Inter', letterSpacing: '-0.06em',
              color: 'var(--fg-faint)',
            }}>×</span>
            <div style={{
              width: 60, height: 60, borderRadius: 'var(--r-pill)',
              background: 'rgba(254,223,0,0.10)',
              border: '1px solid rgba(254,223,0,0.30)',
              display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            }}>
              <span className="material-symbols-outlined ms-fill" style={{ fontSize: 30, color: 'var(--br-yellow)' }}>sports_soccer</span>
            </div>
          </div>
          <ScoreStepper value={1} team="MAR" color="#FF7A8E" side="away" />
        </div>

        {/* sumário do palpite */}
        <div style={{
          marginTop: 36,
          padding: '18px 24px',
          borderRadius: 'var(--r-lg)',
          background: 'rgba(0,0,0,0.30)',
          border: '1px solid var(--border-medium)',
          display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        }}>
          <div style={{ display: 'flex', alignItems: 'center', gap: 14 }}>
            <span className="material-symbols-outlined" style={{ fontSize: 22, color: 'var(--br-yellow)' }}>auto_awesome</span>
            <div>
              <div style={{
                font: '600 11px/1 Inter', letterSpacing: '.12em', textTransform: 'uppercase',
                color: 'var(--fg-muted)', marginBottom: 6,
              }}>Seu palpite</div>
              <div style={{ font: '700 16px/1 Inter', color: '#fff' }}>
                Brasil <span style={{ color: 'var(--br-yellow)' }}>3</span> × <span style={{ color: 'var(--br-yellow)' }}>1</span> Marrocos
                <span style={{ marginLeft: 12, font: '500 13px/1 Inter', color: 'var(--fg-secondary)' }}>
                  · Brasil vence
                </span>
              </div>
            </div>
          </div>

          <div style={{ display: 'flex', gap: 12 }}>
            <button className="btn-ghost" style={{ height: 48 }}>
              Limpar
            </button>
            <button className="btn-gold" style={{ height: 48 }}>
              Confirmar Palpite
              <span className="material-symbols-outlined" style={{ fontSize: 18 }}>arrow_forward</span>
            </button>
          </div>
        </div>
      </div>

      {/* sistema de pontuação */}
      <div style={{
        display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 16,
      }}>
        {[
          { icon: 'gps_fixed', title: 'Placar exato', pts: '+10 pts', color: '#62F49B', desc: 'Acertou os dois gols' },
          { icon: 'flag_circle', title: 'Ganhador certo', pts: '+5 pts', color: '#FEDF00', desc: 'Acertou quem vence' },
          { icon: 'percent', title: 'Gols parciais', pts: '+2 pts', color: '#8EA9FF', desc: 'Acertou gols de 1 time' },
        ].map(c => (
          <div key={c.title} className="card" style={{
            padding: '18px 20px',
            display: 'flex', alignItems: 'center', gap: 14,
          }}>
            <div style={{
              width: 44, height: 44, borderRadius: 'var(--r-md)',
              background: `${c.color}22`,
              border: `1px solid ${c.color}55`,
              display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            }}>
              <span className="material-symbols-outlined" style={{ fontSize: 22, color: c.color }}>{c.icon}</span>
            </div>
            <div>
              <div style={{ display: 'flex', gap: 8, alignItems: 'baseline' }}>
                <span style={{ font: '700 14px/1 Inter', color: '#fff' }}>{c.title}</span>
                <span style={{ font: '800 13px/1 Inter', color: c.color }}>{c.pts}</span>
              </div>
              <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 6 }}>{c.desc}</div>
            </div>
          </div>
        ))}
      </div>

      {showModal && <PalpiteConfirmModal />}
    </>
  );
}

// ----- Tela 1: form ------------------------------------------------------
function PalpiteFormScreen() {
  return (
    <div className="app-root" style={{ background: 'var(--bg-base)' }}>
      <BrazilBgDeco intensity={0.6} />
      <div style={{ position: 'relative', zIndex: 2 }}>
        <TopNav active="jogos" />
        <div style={{
          padding: '24px 32px 40px',
          display: 'flex', flexDirection: 'column', gap: 18,
          maxWidth: 1180, margin: '0 auto',
        }}>
          <PalpiteHeader />
          <PalpiteFormBody />
        </div>
      </div>
    </div>
  );
}

// ----- Modal de confirmação (sobrepondo o form) --------------------------
function PalpiteConfirmModal() {
  return (
    <div style={{
      position: 'absolute', inset: 0,
      background: 'rgba(2,5,15,0.78)',
      backdropFilter: 'blur(12px)',
      display: 'flex', alignItems: 'center', justifyContent: 'center',
      zIndex: 50, padding: 40,
    }}>
      <div style={{
        width: 520,
        background: 'var(--bg-elev-0)',
        border: '1px solid var(--border-medium)',
        borderRadius: 'var(--r-2xl)',
        boxShadow: '0 40px 90px rgba(0,0,0,0.65)',
        overflow: 'hidden',
      }}>
        {/* Cabeçalho amarelo de aviso (FUNDO AMARELO, TEXTO ESCURO conforme brief) */}
        <div style={{
          padding: '20px 24px',
          background: 'var(--grad-yellow)',
          color: '#1A0F00',
          display: 'flex', alignItems: 'center', gap: 14,
          position: 'relative',
        }}>
          {/* stripes decorativas (estilo fita de atenção) */}
          <div style={{
            position: 'absolute', inset: 0, opacity: .12, pointerEvents: 'none',
            backgroundImage: 'repeating-linear-gradient(45deg, rgba(0,0,0,1) 0 12px, transparent 12px 24px)',
          }} />
          <div style={{
            width: 48, height: 48, borderRadius: 'var(--r-md)',
            background: 'rgba(0,0,0,0.12)',
            border: '1.5px solid rgba(0,0,0,0.35)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            zIndex: 1,
          }}>
            <span className="material-symbols-outlined ms-fill" style={{ fontSize: 26, color: '#1A0F00' }}>priority_high</span>
          </div>
          <div style={{ zIndex: 1 }}>
            <div style={{ font: '800 12px/1 Inter', letterSpacing: '.18em', textTransform: 'uppercase', color: '#5A3A00' }}>
              Atenção · ação irreversível
            </div>
            <div style={{ font: '900 22px/1.2 Inter', color: '#1A0F00', marginTop: 6, letterSpacing: '-0.01em' }}>
              Confirmar palpite Brasil 3 × 1 Marrocos?
            </div>
          </div>
        </div>

        {/* corpo */}
        <div style={{ padding: '24px 28px 8px' }}>
          <p style={{
            margin: 0, font: '500 14px/1.55 Inter', color: 'var(--fg-secondary)',
          }}>
            Após confirmar, <strong style={{ color: '#fff' }}>seu palpite não pode ser alterado nem cancelado</strong>. O placar registrado vale pra contagem oficial do bolão e fica visível para todos os participantes após o apito final.
          </p>

          {/* Resumo */}
          <div style={{
            marginTop: 20, padding: '18px 20px',
            borderRadius: 'var(--r-lg)',
            background: 'rgba(0,0,0,0.25)',
            border: '1px solid var(--border-medium)',
          }}>
            <div style={{
              font: '600 10.5px/1 Inter', letterSpacing: '.14em', textTransform: 'uppercase',
              color: 'var(--fg-muted)', marginBottom: 12,
            }}>Resumo do palpite</div>
            <div style={{
              display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 16,
            }}>
              <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                <Flag code="BRA" size={36} />
                <span style={{ font: '700 14px/1 Inter', color: '#fff' }}>Brasil</span>
              </div>
              <div style={{
                font: '900 32px/1 Inter', letterSpacing: '-0.04em',
                fontVariantNumeric: 'tabular-nums', color: 'var(--br-yellow)',
              }}>
                3 <span style={{ color: 'var(--fg-faint)', fontSize: 22 }}>×</span> 1
              </div>
              <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                <span style={{ font: '700 14px/1 Inter', color: '#fff' }}>Marrocos</span>
                <Flag code="MAR" size={36} />
              </div>
            </div>
          </div>

          {/* checkbox */}
          <label style={{
            display: 'inline-flex', alignItems: 'flex-start', gap: 10,
            marginTop: 20, cursor: 'pointer',
            font: '500 12.5px/1.45 Inter', color: 'var(--fg-secondary)',
          }}>
            <span style={{
              width: 18, height: 18,
              borderRadius: 5,
              background: 'var(--br-yellow)',
              display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
              flexShrink: 0, marginTop: 1,
              boxShadow: '0 0 0 3px rgba(254,223,0,0.15)',
            }}>
              <span className="material-symbols-outlined" style={{ fontSize: 14, color: '#1A0F00', fontWeight: 800 }}>check</span>
            </span>
            Entendo que o palpite é definitivo e que não posso alterá-lo após confirmar.
          </label>
        </div>

        {/* footer */}
        <div style={{
          display: 'flex', gap: 12, padding: '20px 28px 24px',
        }}>
          <button className="btn-ghost" style={{ flex: 1, height: 48 }}>
            Voltar e revisar
          </button>
          <button className="btn-primary" style={{ flex: 1.4, height: 48 }}>
            <span className="material-symbols-outlined" style={{ fontSize: 18 }}>lock</span>
            Confirmar definitivamente
          </button>
        </div>
      </div>
    </div>
  );
}

// ----- Tela 2: confirmação modal ----------------------------------------
function PalpiteConfirmScreen() {
  return (
    <div className="app-root" style={{ background: 'var(--bg-base)' }}>
      <BrazilBgDeco intensity={0.6} />
      <div style={{ position: 'relative', zIndex: 2 }}>
        <TopNav active="jogos" />
        <div style={{
          padding: '24px 32px 40px',
          display: 'flex', flexDirection: 'column', gap: 18,
          maxWidth: 1180, margin: '0 auto',
        }}>
          <PalpiteHeader />
          <PalpiteFormBody showModal />
        </div>
      </div>
    </div>
  );
}

// ----- Tela 3: revelação dos palpites ------------------------------------
function PalpiteRevealScreen() {
  return (
    <div className="app-root" style={{ background: 'var(--bg-base)' }}>
      <BrazilBgDeco intensity={0.6} />
      <div style={{ position: 'relative', zIndex: 2 }}>
        <TopNav active="jogos" />
        <div style={{
          padding: '24px 32px 48px',
          display: 'flex', flexDirection: 'column', gap: 22,
          maxWidth: 1280, margin: '0 auto',
        }}>
          {/* hero da revelação */}
          <div className="card" style={{
            padding: 0,
            borderRadius: 'var(--r-2xl)',
            overflow: 'hidden',
            background: 'linear-gradient(180deg, #0E1A4A 0%, #07102C 100%)',
          }}>
            <div style={{
              padding: '18px 26px',
              borderBottom: '1px solid var(--border-soft)',
              display: 'flex', alignItems: 'center', justifyContent: 'space-between',
            }}>
              <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                <span className="chip green">
                  <span style={{ width: 6, height: 6, borderRadius: 99, background: '#1FD66B' }} />
                  Revelados
                </span>
                <span className="chip">Grupo G · Jogo 1 · 15 jun 2026</span>
              </div>
              <button className="btn-ghost" style={{ height: 36 }}>
                <span className="material-symbols-outlined" style={{ fontSize: 17 }}>filter_list</span>
                Filtrar palpites
              </button>
            </div>
            <div style={{
              display: 'grid', gridTemplateColumns: '1fr auto 1fr',
              alignItems: 'center', gap: 24,
              padding: '26px 40px',
            }}>
              <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 10 }}>
                <Flag code="BRA" size={72} />
                <div style={{ font: '700 16px/1 Inter', color: '#fff' }}>Brasil</div>
              </div>
              <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 6 }}>
                <div style={{
                  font: '600 10.5px/1 Inter', letterSpacing: '.16em', textTransform: 'uppercase',
                  color: 'var(--fg-muted)',
                }}>Placar final oficial</div>
                <div style={{
                  display: 'flex', gap: 14, alignItems: 'center',
                  font: '900 72px/1 Inter', letterSpacing: '-0.05em',
                  fontVariantNumeric: 'tabular-nums',
                }}>
                  <span style={{ color: 'var(--br-yellow)' }}>2</span>
                  <span style={{ color: 'var(--fg-faint)', fontSize: 42 }}>×</span>
                  <span style={{ color: '#fff' }}>1</span>
                </div>
                <div style={{
                  display: 'inline-flex', gap: 6, alignItems: 'center',
                  marginTop: 4,
                  padding: '5px 12px',
                  borderRadius: 'var(--r-pill)',
                  background: 'rgba(31,214,107,0.12)',
                  border: '1px solid rgba(31,214,107,0.35)',
                  font: '700 11px/1 Inter', color: '#62F49B',
                }}>
                  <span className="material-symbols-outlined" style={{ fontSize: 13 }}>verified</span>
                  Brasil venceu · 3 acertaram o placar exato
                </div>
              </div>
              <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 10 }}>
                <Flag code="MAR" size={72} />
                <div style={{ font: '700 16px/1 Inter', color: '#fff' }}>Marrocos</div>
              </div>
            </div>
          </div>

          {/* legenda */}
          <div style={{
            display: 'flex', justifyContent: 'space-between', alignItems: 'flex-end',
            paddingInline: 4,
          }}>
            <div>
              <h2 style={{
                margin: 0, font: '800 22px/1.1 Inter', letterSpacing: '-0.02em', color: '#fff',
              }}>Palpites dos 20 participantes</h2>
              <div style={{ font: '500 13px/1.4 Inter', color: 'var(--fg-muted)', marginTop: 6 }}>
                Os palpites foram revelados após o apito final. Pontuação aplicada automaticamente.
              </div>
            </div>
            <div style={{ display: 'flex', gap: 6, alignItems: 'center' }}>
              <LegendDot color="#62F49B" label="Exato (+10)" />
              <LegendDot color="#FEDF00" label="Ganhador (+5)" />
              <LegendDot color="#8EA9FF" label="Parcial (+2)" />
              <LegendDot color="var(--fg-faint)" label="Errou" />
            </div>
          </div>

          {/* grid */}
          <div style={{
            display: 'grid', gridTemplateColumns: 'repeat(5, 1fr)', gap: 14,
          }}>
            {PARTICIPANTS.map((p, i) => {
              const final = [2, 1];
              const ex = p.palpite[0] === final[0] && p.palpite[1] === final[1];
              const winner = (p.palpite[0] > p.palpite[1]) === (final[0] > final[1]) &&
                             (p.palpite[0] === p.palpite[1]) === (final[0] === final[1]);
              const partial = p.palpite[0] === final[0] || p.palpite[1] === final[1];

              let kind = 'miss';
              if (ex) kind = 'exato';
              else if (winner && partial) kind = 'winnerPartial';
              else if (winner) kind = 'winner';
              else if (partial) kind = 'partial';

              const styles = {
                exato:         { color: '#62F49B', bg: 'rgba(31,214,107,0.10)', border: 'rgba(31,214,107,0.40)', label: 'EXATO · +10', icon: 'gps_fixed' },
                winner:        { color: '#FEDF00', bg: 'rgba(254,223,0,0.08)',  border: 'rgba(254,223,0,0.35)',  label: 'GANHADOR · +5', icon: 'flag_circle' },
                winnerPartial: { color: '#FEDF00', bg: 'rgba(254,223,0,0.08)',  border: 'rgba(254,223,0,0.35)',  label: 'GANHADOR +PARCIAL · +7', icon: 'flag_circle' },
                partial:       { color: '#8EA9FF', bg: 'rgba(142,169,255,0.08)', border: 'rgba(142,169,255,0.35)', label: 'PARCIAL · +2', icon: 'percent' },
                miss:          { color: 'rgba(255,255,255,0.35)', bg: 'rgba(255,255,255,0.02)', border: 'var(--border-medium)', label: 'ERROU · +0', icon: 'close' },
              }[kind];

              return (
                <div key={p.name} style={{
                  position: 'relative',
                  padding: '16px 16px 14px',
                  borderRadius: 'var(--r-lg)',
                  background: styles.bg,
                  border: `1px solid ${styles.border}`,
                  display: 'flex', flexDirection: 'column', gap: 12,
                  outline: p.isMe ? '2px solid var(--br-green-bright)' : 'none',
                  outlineOffset: p.isMe ? 1 : 0,
                }}>
                  {p.isMe && (
                    <div style={{
                      position: 'absolute', top: -10, right: 10,
                      padding: '3px 8px',
                      borderRadius: 'var(--r-pill)',
                      background: 'var(--br-green-bright)',
                      font: '700 9.5px/1 Inter', letterSpacing: '.10em', color: '#04150A',
                    }}>VOCÊ</div>
                  )}
                  <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
                    <div style={{
                      width: 36, height: 36, borderRadius: '50%',
                      background: `linear-gradient(135deg, ${avatarGrad(i)})`,
                      display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                      font: '700 12px/1 Inter', color: '#fff',
                      border: '1px solid var(--border-medium)',
                      flexShrink: 0,
                    }}>{p.i}</div>
                    <div style={{ minWidth: 0 }}>
                      <div style={{
                        font: '600 12.5px/1.2 Inter', color: '#fff',
                        whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis',
                      }}>{p.name}</div>
                      <div style={{ font: '500 10.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 4 }}>
                        {i + 1 <= 9 ? `Top ${i + 1}` : `Pos #${i + 1}`}
                      </div>
                    </div>
                  </div>
                  {/* placar do palpite */}
                  <div style={{
                    display: 'flex', alignItems: 'center', justifyContent: 'center', gap: 10,
                    padding: '12px 0',
                    borderRadius: 'var(--r-md)',
                    background: 'rgba(0,0,0,0.25)',
                  }}>
                    <span style={{
                      font: '900 28px/1 Inter', color: '#fff',
                      letterSpacing: '-0.04em', fontVariantNumeric: 'tabular-nums',
                    }}>{p.palpite[0]}</span>
                    <span style={{ font: '700 16px/1 Inter', color: 'var(--fg-faint)' }}>×</span>
                    <span style={{
                      font: '900 28px/1 Inter', color: '#fff',
                      letterSpacing: '-0.04em', fontVariantNumeric: 'tabular-nums',
                    }}>{p.palpite[1]}</span>
                  </div>
                  {/* outcome chip */}
                  <div style={{
                    display: 'inline-flex', alignItems: 'center', gap: 6,
                    padding: '5px 10px',
                    borderRadius: 'var(--r-pill)',
                    background: 'rgba(0,0,0,0.30)',
                    border: `1px solid ${styles.border}`,
                    alignSelf: 'flex-start',
                  }}>
                    <span className="material-symbols-outlined" style={{ fontSize: 13, color: styles.color }}>{styles.icon}</span>
                    <span style={{ font: '700 10px/1 Inter', letterSpacing: '.08em', color: styles.color }}>
                      {styles.label}
                    </span>
                  </div>
                </div>
              );
            })}
          </div>
        </div>
      </div>
    </div>
  );
}

function LegendDot({ color, label }) {
  return (
    <span style={{
      display: 'inline-flex', alignItems: 'center', gap: 6,
      padding: '6px 11px',
      borderRadius: 'var(--r-pill)',
      background: 'rgba(255,255,255,0.03)',
      border: '1px solid var(--border-soft)',
    }}>
      <span style={{ width: 7, height: 7, borderRadius: 99, background: color }} />
      <span style={{ font: '600 11px/1 Inter', color: 'var(--fg-secondary)' }}>{label}</span>
    </span>
  );
}

Object.assign(window, {
  PalpiteFormScreen, PalpiteConfirmScreen, PalpiteRevealScreen,
});
