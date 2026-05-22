// admin.jsx — painel admin simplificado

function AdminScreen() {
  const jogos = [
    { rodada: 1, vs: ['BRA', 'MAR'], data: '15 jun · 16:00', status: 'open', palpites: 18 },
    { rodada: 2, vs: ['BRA', 'HAI'], data: '20 jun · 13:00', status: 'pending', palpites: 0 },
    { rodada: 3, vs: ['BRA', 'SCO'], data: '24 jun · 16:00', status: 'pending', palpites: 0 },
    { rodada: 0, vs: ['BRA', 'SUI'], data: '11 jun · 16:00', status: 'finished', placar: [2, 1], palpites: 20 },
  ];

  return (
    <div className="app-root" style={{ background: 'var(--bg-base)' }}>
      <BrazilBgDeco intensity={0.5} />

      <div style={{ position: 'relative', zIndex: 2 }}>
        <TopNav active="admin" user="Marina Costa" userInitials="MC" isAdmin />

        <div style={{
          padding: '28px 32px 48px',
          maxWidth: 1280, margin: '0 auto',
          display: 'flex', flexDirection: 'column', gap: 22,
        }}>
          {/* heading */}
          <div style={{ display: 'flex', alignItems: 'flex-end', justifyContent: 'space-between' }}>
            <div>
              <div style={{
                font: '600 11px/1 Inter', letterSpacing: '.16em', textTransform: 'uppercase',
                color: 'var(--br-yellow)', marginBottom: 10,
                display: 'inline-flex', gap: 8, alignItems: 'center',
              }}>
                <span className="material-symbols-outlined" style={{ fontSize: 13 }}>shield_person</span>
                Painel administrativo
              </div>
              <h1 style={{
                margin: 0, font: '800 28px/1.1 Inter', letterSpacing: '-0.02em', color: '#fff',
              }}>
                Gerenciar bolão
              </h1>
              <p style={{ margin: '8px 0 0', font: '500 13.5px/1.5 Inter', color: 'var(--fg-secondary)' }}>
                Cadastre resultados, ajuste prêmio e acompanhe os palpites em tempo real.
              </p>
            </div>
            <div style={{ display: 'flex', gap: 10 }}>
              <button className="btn-ghost" style={{ height: 40 }}>
                <span className="material-symbols-outlined" style={{ fontSize: 18 }}>file_download</span>
                Exportar ranking (CSV)
              </button>
              <button className="btn-primary" style={{ height: 40, fontSize: 13 }}>
                <span className="material-symbols-outlined" style={{ fontSize: 18 }}>add</span>
                Novo jogo
              </button>
            </div>
          </div>

          {/* KPIs */}
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: 16 }}>
            {[
              { label: 'Participantes ativos', value: '20', sub: '/ 24 elegíveis', icon: 'group', color: '#62F49B' },
              { label: 'Jogos cadastrados', value: '4', sub: 'fase de grupos', icon: 'sports_soccer', color: '#FEDF00' },
              { label: 'Palpites enviados', value: '18', sub: 'no jogo atual', icon: 'edit_note', color: '#8EA9FF' },
              { label: 'Prêmio configurado', value: 'R$ 200', sub: '+ 1 day off', icon: 'workspace_premium', color: '#FFD96B' },
            ].map((k, i) => (
              <div key={k.label} className="card" style={{ padding: 18 }}>
                <div style={{
                  display: 'flex', alignItems: 'center', gap: 12, marginBottom: 14,
                }}>
                  <div style={{
                    width: 36, height: 36, borderRadius: 'var(--r-md)',
                    background: `${k.color}22`,
                    border: `1px solid ${k.color}55`,
                    display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                  }}>
                    <span className="material-symbols-outlined" style={{ fontSize: 20, color: k.color }}>{k.icon}</span>
                  </div>
                  <span style={{
                    font: '600 11px/1.2 Inter', letterSpacing: '.10em', textTransform: 'uppercase',
                    color: 'var(--fg-muted)',
                  }}>{k.label}</span>
                </div>
                <div style={{ display: 'flex', alignItems: 'baseline', gap: 8 }}>
                  <span style={{ font: '800 26px/1 Inter', letterSpacing: '-0.03em', color: '#fff' }}>{k.value}</span>
                  <span style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)' }}>{k.sub}</span>
                </div>
              </div>
            ))}
          </div>

          {/* Lista de jogos + lateral */}
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 380px', gap: 22 }}>
            {/* Lista de jogos */}
            <div className="card" style={{ padding: 0, borderRadius: 'var(--r-2xl)', overflow: 'hidden' }}>
              <div style={{
                padding: '18px 24px',
                borderBottom: '1px solid var(--border-soft)',
                display: 'flex', alignItems: 'center', justifyContent: 'space-between',
              }}>
                <div>
                  <div style={{ font: '700 15px/1 Inter', color: '#fff' }}>Jogos do Brasil</div>
                  <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
                    4 jogos · Grupo G
                  </div>
                </div>
                <div style={{
                  display: 'flex', gap: 4, padding: 4,
                  background: 'rgba(255,255,255,0.04)',
                  borderRadius: 'var(--r-pill)',
                  border: '1px solid var(--border-medium)',
                }}>
                  {['Todos', 'Em aberto', 'Encerrados'].map((t, i) => (
                    <button key={t} style={{
                      height: 28, padding: '0 12px',
                      borderRadius: 'var(--r-pill)', border: 'none',
                      background: i === 0 ? 'rgba(255,255,255,0.08)' : 'transparent',
                      color: i === 0 ? '#fff' : 'var(--fg-secondary)',
                      font: '600 11.5px/1 Inter', cursor: 'pointer',
                    }}>{t}</button>
                  ))}
                </div>
              </div>

              {/* header tabela */}
              <div className="tbl-row" style={{
                gridTemplateColumns: '56px 1fr 130px 110px 110px 130px',
                padding: '12px 24px',
                background: 'rgba(255,255,255,0.02)',
                font: '600 10.5px/1 Inter', letterSpacing: '.12em',
                textTransform: 'uppercase', color: 'var(--fg-muted)',
                borderBottom: '1px solid var(--border-medium)',
              }}>
                <div>RD</div>
                <div>Confronto</div>
                <div>Data</div>
                <div>Status</div>
                <div>Palpites</div>
                <div style={{ textAlign: 'right' }}>Ação</div>
              </div>

              {jogos.map((j, i) => {
                const isFin = j.status === 'finished';
                const isOpen = j.status === 'open';
                const statusStyle = isFin
                  ? { color: '#62F49B', bg: 'rgba(31,214,107,0.10)', border: 'rgba(31,214,107,0.35)', label: 'ENCERRADO', dot: '#1FD66B' }
                  : isOpen
                  ? { color: '#FEDF00', bg: 'rgba(254,223,0,0.10)', border: 'rgba(254,223,0,0.35)', label: 'EM ABERTO', dot: '#FEDF00' }
                  : { color: 'var(--fg-muted)', bg: 'rgba(255,255,255,0.04)', border: 'var(--border-medium)', label: 'PROGRAMADO', dot: 'var(--fg-faint)' };
                return (
                  <div key={i} className="tbl-row" style={{
                    gridTemplateColumns: '56px 1fr 130px 110px 110px 130px',
                    padding: '14px 24px',
                  }}>
                    <div style={{
                      width: 32, height: 32, borderRadius: 'var(--r-md)',
                      background: 'rgba(255,255,255,0.04)',
                      border: '1px solid var(--border-medium)',
                      display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                      font: '700 12.5px/1 Inter', color: '#fff',
                    }}>{j.rodada}</div>
                    <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
                      <Flag code={j.vs[0]} size={32} />
                      {isFin ? (
                        <div style={{
                          display: 'inline-flex', alignItems: 'center', gap: 8,
                          font: '800 18px/1 Inter', color: '#fff',
                          fontVariantNumeric: 'tabular-nums',
                        }}>
                          <span style={{ color: 'var(--br-yellow)' }}>{j.placar[0]}</span>
                          <span style={{ color: 'var(--fg-faint)', fontSize: 14 }}>×</span>
                          <span>{j.placar[1]}</span>
                        </div>
                      ) : (
                        <div style={{ font: '600 14px/1 Inter', color: 'var(--fg-secondary)' }}>vs</div>
                      )}
                      <Flag code={j.vs[1]} size={32} />
                      <div style={{ marginLeft: 8 }}>
                        <div style={{ font: '600 13.5px/1 Inter', color: '#fff' }}>
                          {TEAM_NAMES[j.vs[0]]} × {TEAM_NAMES[j.vs[1]]}
                        </div>
                        <div style={{ font: '500 11.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 4 }}>
                          Grupo G
                        </div>
                      </div>
                    </div>
                    <div style={{ font: '500 13px/1.3 Inter', color: 'var(--fg-secondary)' }}>{j.data}</div>
                    <div>
                      <span style={{
                        display: 'inline-flex', alignItems: 'center', gap: 6,
                        padding: '4px 10px',
                        borderRadius: 'var(--r-pill)',
                        background: statusStyle.bg,
                        border: `1px solid ${statusStyle.border}`,
                        font: '700 10px/1 Inter', letterSpacing: '.12em',
                        color: statusStyle.color,
                      }}>
                        <span style={{ width: 6, height: 6, borderRadius: 99, background: statusStyle.dot }} />
                        {statusStyle.label}
                      </span>
                    </div>
                    <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
                      <span style={{
                        font: '700 14px/1 Inter', color: '#fff', fontVariantNumeric: 'tabular-nums',
                      }}>{j.palpites}</span>
                      <span style={{ font: '500 11.5px/1 Inter', color: 'var(--fg-muted)' }}>/ 20</span>
                    </div>
                    <div style={{ display: 'flex', justifyContent: 'flex-end', gap: 6 }}>
                      {isFin && (
                        <button style={iconBtnStyle}>
                          <span className="material-symbols-outlined" style={{ fontSize: 16 }}>visibility</span>
                        </button>
                      )}
                      {!isFin && (
                        <button style={{ ...iconBtnStyle, color: 'var(--br-yellow)', borderColor: 'rgba(254,223,0,0.35)' }}>
                          <span className="material-symbols-outlined" style={{ fontSize: 16 }}>scoreboard</span>
                        </button>
                      )}
                      <button style={iconBtnStyle}>
                        <span className="material-symbols-outlined" style={{ fontSize: 16 }}>edit</span>
                      </button>
                      <button style={iconBtnStyle}>
                        <span className="material-symbols-outlined" style={{ fontSize: 16 }}>more_horiz</span>
                      </button>
                    </div>
                  </div>
                );
              })}
            </div>

            {/* Lateral: form de resultado + prêmio */}
            <div style={{ display: 'flex', flexDirection: 'column', gap: 18 }}>
              {/* Form cadastrar resultado */}
              <div className="card" style={{ padding: 22, borderRadius: 'var(--r-2xl)' }}>
                <div style={{
                  display: 'flex', alignItems: 'center', gap: 10, marginBottom: 16,
                }}>
                  <div style={{
                    width: 32, height: 32, borderRadius: 'var(--r-md)',
                    background: 'rgba(31,214,107,0.10)',
                    border: '1px solid rgba(31,214,107,0.35)',
                    display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                  }}>
                    <span className="material-symbols-outlined" style={{ fontSize: 18, color: '#62F49B' }}>scoreboard</span>
                  </div>
                  <div>
                    <div style={{ font: '700 14px/1 Inter', color: '#fff' }}>Cadastrar resultado</div>
                    <div style={{ font: '500 11.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 4 }}>Jogo Brasil × Marrocos</div>
                  </div>
                </div>

                <label className="field-label">Jogo</label>
                <div style={{ position: 'relative', marginBottom: 16 }}>
                  <div style={{
                    height: 46, padding: '0 14px 0 14px',
                    background: 'rgba(255,255,255,0.04)',
                    border: '1px solid var(--border-medium)',
                    borderRadius: 'var(--r-md)',
                    display: 'flex', alignItems: 'center', justifyContent: 'space-between',
                    color: '#fff', font: '500 13.5px/1 Inter',
                  }}>
                    <span style={{ display: 'inline-flex', alignItems: 'center', gap: 8 }}>
                      <Flag code="BRA" size={20} />
                      Brasil × Marrocos
                      <Flag code="MAR" size={20} />
                    </span>
                    <span className="material-symbols-outlined" style={{ fontSize: 18, color: 'var(--fg-muted)' }}>expand_more</span>
                  </div>
                </div>

                <label className="field-label">Placar final</label>
                <div style={{
                  display: 'grid', gridTemplateColumns: '1fr auto 1fr', alignItems: 'center', gap: 12,
                  marginBottom: 18,
                }}>
                  <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 6 }}>
                    <Flag code="BRA" size={32} />
                    <div style={{
                      width: '100%', height: 64,
                      background: 'rgba(0,0,0,0.30)',
                      border: '1.5px solid var(--br-yellow)',
                      borderRadius: 'var(--r-md)',
                      display: 'flex', alignItems: 'center', justifyContent: 'center',
                      font: '900 36px/1 Inter', color: 'var(--br-yellow)',
                      fontVariantNumeric: 'tabular-nums', letterSpacing: '-0.04em',
                      boxShadow: '0 0 0 4px rgba(254,223,0,0.10)',
                    }}>2</div>
                  </div>
                  <span style={{ font: '700 24px/1 Inter', color: 'var(--fg-faint)' }}>×</span>
                  <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 6 }}>
                    <Flag code="MAR" size={32} />
                    <div style={{
                      width: '100%', height: 64,
                      background: 'rgba(0,0,0,0.30)',
                      border: '1px solid var(--border-medium)',
                      borderRadius: 'var(--r-md)',
                      display: 'flex', alignItems: 'center', justifyContent: 'center',
                      font: '900 36px/1 Inter', color: '#fff',
                      fontVariantNumeric: 'tabular-nums', letterSpacing: '-0.04em',
                    }}>1</div>
                  </div>
                </div>

                <button className="btn-primary" style={{ width: '100%', height: 46 }}>
                  <span className="material-symbols-outlined" style={{ fontSize: 18 }}>check_circle</span>
                  Lançar resultado e pontuar
                </button>
                <div style={{
                  marginTop: 12,
                  padding: '10px 12px',
                  borderRadius: 'var(--r-md)',
                  background: 'rgba(255,77,106,0.08)',
                  border: '1px solid rgba(255,77,106,0.25)',
                  display: 'flex', alignItems: 'flex-start', gap: 8,
                }}>
                  <span className="material-symbols-outlined" style={{ fontSize: 14, color: '#FF7A8E', marginTop: 1 }}>warning</span>
                  <div style={{ font: '500 11px/1.45 Inter', color: 'var(--fg-secondary)' }}>
                    Após lançar, o ranking é recalculado e os palpites ficam <strong style={{ color: '#fff' }}>visíveis pra todos</strong>.
                  </div>
                </div>
              </div>

              {/* Configuração de prêmio */}
              <div className="card" style={{
                padding: 22,
                borderRadius: 'var(--r-2xl)',
                background: 'linear-gradient(180deg, #1A1206 0%, #0A0703 100%)',
                border: '1px solid rgba(242,201,76,0.25)',
              }}>
                <div style={{
                  display: 'flex', alignItems: 'center', gap: 10, marginBottom: 16,
                }}>
                  <div style={{
                    width: 32, height: 32, borderRadius: 'var(--r-md)',
                    background: 'var(--grad-gold-chip)',
                    display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                    boxShadow: '0 4px 10px rgba(242,201,76,0.30)',
                  }}>
                    <span className="material-symbols-outlined ms-fill" style={{ fontSize: 18, color: '#5A3A00' }}>trophy</span>
                  </div>
                  <div>
                    <div style={{ font: '700 14px/1 Inter', color: '#fff' }}>Prêmio do bolão</div>
                    <div style={{ font: '500 11.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 4 }}>Disputado pelo top 1</div>
                  </div>
                </div>

                <label className="field-label">Valor em R$</label>
                <div style={{ position: 'relative', marginBottom: 12 }}>
                  <span style={{
                    position: 'absolute', left: 14, top: '50%', transform: 'translateY(-50%)',
                    font: '700 14px/1 Inter', color: 'var(--fg-muted)',
                  }}>R$</span>
                  <input
                    defaultValue="200,00"
                    style={{
                      width: '100%', height: 46,
                      padding: '0 14px 0 44px',
                      background: 'rgba(0,0,0,0.30)',
                      border: '1px solid rgba(242,201,76,0.30)',
                      borderRadius: 'var(--r-md)',
                      color: '#FFE08A',
                      font: '800 18px/1 Inter',
                      fontVariantNumeric: 'tabular-nums',
                      letterSpacing: '-0.02em',
                      outline: 'none',
                    }}
                  />
                </div>

                <label className="field-label">Bônus extra (opcional)</label>
                <input
                  defaultValue="1 day off remunerado"
                  className="input"
                  style={{ height: 44, paddingLeft: 14 }}
                />

                <button className="btn-gold" style={{ width: '100%', height: 44, marginTop: 14, fontSize: 13.5 }}>
                  <span className="material-symbols-outlined" style={{ fontSize: 16 }}>save</span>
                  Salvar prêmio
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

const iconBtnStyle = {
  width: 32, height: 32, borderRadius: 'var(--r-md)',
  background: 'rgba(255,255,255,0.04)',
  border: '1px solid var(--border-medium)',
  color: 'var(--fg-secondary)',
  display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
  cursor: 'pointer',
};

Object.assign(window, { AdminScreen });
