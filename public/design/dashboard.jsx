// dashboard.jsx — tela principal pós-login

function CountdownPart({ value, label }) {
  return (
    <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 4 }}>
      <div style={{
        minWidth: 56, padding: '10px 12px',
        borderRadius: 'var(--r-md)',
        background: 'rgba(0,0,0,0.38)',
        border: '1px solid var(--border-medium)',
        font: '800 26px/1 Inter',
        fontVariantNumeric: 'tabular-nums',
        letterSpacing: '-0.03em',
        color: '#fff',
        textAlign: 'center',
        boxShadow: '0 2px 0 rgba(255,255,255,0.06) inset',
      }}>{value}</div>
      <span style={{
        font: '600 10px/1 Inter', letterSpacing: '.14em', textTransform: 'uppercase',
        color: 'var(--fg-muted)',
      }}>{label}</span>
    </div>
  );
}

function HeroNextMatch() {
  return (
    <div className="card" style={{
      gridColumn: '1 / span 8',
      padding: 0,
      overflow: 'hidden',
      background: 'linear-gradient(180deg, #0E1A4A 0%, #07102C 100%)',
      border: '1px solid rgba(255,255,255,0.10)',
      borderRadius: 'var(--r-2xl)',
      position: 'relative',
    }}>
      {/* faixa decorativa diagonal verde/amarela */}
      <div style={{
        position: 'absolute', top: 0, right: 0, width: 380, height: '100%',
        opacity: .6, pointerEvents: 'none',
        background: 'radial-gradient(ellipse 80% 60% at 100% 30%, rgba(254,223,0,0.18) 0%, transparent 60%)',
      }} />

      {/* header strip */}
      <div style={{
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        padding: '18px 28px',
        borderBottom: '1px solid var(--border-soft)',
        position: 'relative', zIndex: 2,
      }}>
        <div style={{ display: 'flex', gap: 10, alignItems: 'center' }}>
          <span className="chip yellow">
            <span className="material-symbols-outlined" style={{ fontSize: 13 }}>schedule</span>
            Próximo jogo
          </span>
          <span className="chip">Fase de Grupos · Grupo G · Jogo 1</span>
        </div>
        <div style={{ font: '500 12.5px/1 Inter', color: 'var(--fg-muted)' }}>
          <span className="material-symbols-outlined" style={{
            fontSize: 14, verticalAlign: '-2px', marginRight: 6, color: 'var(--fg-faint)',
          }}>stadium</span>
          Estádio Azteca · Cidade do México
        </div>
      </div>

      {/* hero body — placar gigante */}
      <div style={{
        display: 'grid',
        gridTemplateColumns: '1fr auto 1fr',
        alignItems: 'center',
        gap: 24,
        padding: '36px 40px 28px',
        position: 'relative', zIndex: 2,
      }}>
        {/* Brasil */}
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 14 }}>
          <Flag code="BRA" size={108} />
          <div style={{ textAlign: 'center' }}>
            <div style={{ font: '800 38px/1 Inter', letterSpacing: '-0.04em', color: '#fff' }}>BRA</div>
            <div style={{ font: '500 12.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 8, letterSpacing: '.08em' }}>
              BRASIL
            </div>
          </div>
        </div>

        {/* meio: VS + countdown */}
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 16, minWidth: 320 }}>
          <div style={{ font: '900 56px/1 Inter', letterSpacing: '-0.06em', color: 'var(--fg-faint)' }}>VS</div>
          <div style={{
            display: 'flex', gap: 10, alignItems: 'flex-end',
          }}>
            <CountdownPart value="03" label="DIAS" />
            <span style={{ color: 'var(--fg-faint)', font: '800 24px/1.2 Inter' }}>:</span>
            <CountdownPart value="14" label="HORAS" />
            <span style={{ color: 'var(--fg-faint)', font: '800 24px/1.2 Inter' }}>:</span>
            <CountdownPart value="22" label="MIN" />
            <span style={{ color: 'var(--fg-faint)', font: '800 24px/1.2 Inter' }}>:</span>
            <CountdownPart value="08" label="SEG" />
          </div>
          <div style={{
            display: 'inline-flex', gap: 8, alignItems: 'center',
            font: '600 12px/1 Inter', color: 'var(--fg-secondary)',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 14, color: 'var(--br-yellow)' }}>event</span>
            15 jun 2026 · 16:00 (horário de Brasília)
          </div>
        </div>

        {/* Marrocos */}
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 14 }}>
          <Flag code="MAR" size={108} />
          <div style={{ textAlign: 'center' }}>
            <div style={{ font: '800 38px/1 Inter', letterSpacing: '-0.04em', color: '#fff' }}>MAR</div>
            <div style={{ font: '500 12.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 8, letterSpacing: '.08em' }}>
              MARROCOS
            </div>
          </div>
        </div>
      </div>

      {/* footer CTA */}
      <div style={{
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        padding: '18px 28px',
        borderTop: '1px solid var(--border-soft)',
        background: 'rgba(0,0,0,0.20)',
        position: 'relative', zIndex: 2,
      }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
          <div style={{
            width: 36, height: 36,
            borderRadius: 'var(--r-pill)',
            border: '1px solid rgba(255,77,106,0.40)',
            background: 'rgba(255,77,106,0.10)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 18, color: '#FF7A8E' }}>timer</span>
          </div>
          <div>
            <div style={{ font: '700 13px/1 Inter', color: '#fff' }}>Palpites se encerram em 3d 14h</div>
            <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
              Após o apito inicial, nenhum palpite pode ser alterado.
            </div>
          </div>
        </div>
        <button className="btn-gold" style={{ height: 52, fontSize: 14.5 }}>
          <span className="material-symbols-outlined" style={{ fontSize: 18 }}>edit_note</span>
          Fazer meu palpite
          <span className="material-symbols-outlined" style={{ fontSize: 18 }}>arrow_forward</span>
        </button>
      </div>
    </div>
  );
}

function PrizeCard() {
  return (
    <div className="card" style={{
      gridColumn: 'span 4',
      padding: 24,
      borderRadius: 'var(--r-2xl)',
      background: 'linear-gradient(180deg, #1A1206 0%, #0A0703 100%)',
      border: '1px solid rgba(242,201,76,0.30)',
      position: 'relative',
      overflow: 'hidden',
    }}>
      {/* glow */}
      <div style={{
        position: 'absolute', top: -80, right: -80, width: 240, height: 240,
        borderRadius: '50%',
        background: 'radial-gradient(circle, rgba(242,201,76,0.30) 0%, transparent 70%)',
        filter: 'blur(20px)',
      }} />

      <div style={{ position: 'relative', zIndex: 2 }}>
        <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: 18 }}>
          <span className="chip gold">
            <span className="material-symbols-outlined" style={{ fontSize: 13 }}>emoji_events</span>
            Prêmio do Bolão
          </span>
          <div style={{
            width: 30, height: 30, borderRadius: '50%',
            background: 'rgba(242,201,76,0.10)',
            border: '1px solid rgba(242,201,76,0.30)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            cursor: 'pointer',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 16, color: '#FFD96B' }}>info</span>
          </div>
        </div>

        {/* Trophy icon */}
        <div style={{ display: 'flex', justifyContent: 'center', marginBottom: 12 }}>
          <div style={{
            width: 64, height: 64,
            borderRadius: 'var(--r-lg)',
            background: 'var(--grad-gold-chip)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
            boxShadow: '0 12px 30px rgba(242,201,76,0.30), 0 1px 0 rgba(255,255,255,0.6) inset',
          }}>
            <span className="material-symbols-outlined ms-fill" style={{ fontSize: 36, color: '#5A3A00' }}>trophy</span>
          </div>
        </div>

        <div style={{ textAlign: 'center' }}>
          <div style={{
            font: '900 52px/1 Inter', letterSpacing: '-0.04em',
            color: '#FFE08A',
            textShadow: '0 4px 12px rgba(242,201,76,0.30)',
          }}>
            R$ <span style={{ fontSize: 64 }}>200</span>
          </div>
          <div style={{ font: '600 13px/1 Inter', color: 'var(--fg-secondary)', marginTop: 10 }}>
            +<span style={{ color: '#FFD96B', fontWeight: 700 }}> 1 Day Off</span> remunerado
          </div>
        </div>

        <div style={{
          marginTop: 22, padding: '12px 14px',
          borderRadius: 'var(--r-md)',
          background: 'rgba(255,255,255,0.04)',
          border: '1px solid var(--border-medium)',
          display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        }}>
          <div>
            <div style={{ font: '500 11px/1 Inter', color: 'var(--fg-muted)', letterSpacing: '.12em', textTransform: 'uppercase' }}>
              Líder atual
            </div>
            <div style={{ font: '700 14px/1 Inter', color: '#fff', marginTop: 6 }}>Camila Moraes</div>
          </div>
          <div style={{ display: 'flex', alignItems: 'center', gap: 6 }}>
            <span className="material-symbols-outlined" style={{ fontSize: 16, color: '#FFD96B' }}>workspace_premium</span>
            <span style={{ font: '700 16px/1 Inter', color: '#fff' }}>28 <span style={{ fontSize: 11, color: 'var(--fg-muted)', fontWeight: 600 }}>pts</span></span>
          </div>
        </div>
      </div>
    </div>
  );
}

function MedalBadge({ pos }) {
  const colors = {
    1: { bg: '#F2C94C', fg: '#5A3A00', label: 'OURO' },
    2: { bg: '#C8CDE4', fg: '#202649', label: 'PRATA' },
    3: { bg: '#C77B3E', fg: '#2A1606', label: 'BRONZE' },
  };
  if (!colors[pos]) {
    return (
      <div style={{
        width: 32, height: 32,
        borderRadius: 'var(--r-md)',
        background: 'rgba(255,255,255,0.04)',
        border: '1px solid var(--border-medium)',
        display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
        font: '700 13px/1 Inter', color: 'var(--fg-secondary)',
        fontVariantNumeric: 'tabular-nums',
      }}>{pos}</div>
    );
  }
  const c = colors[pos];
  return (
    <div style={{
      width: 32, height: 32,
      borderRadius: 'var(--r-md)',
      background: `linear-gradient(180deg, ${c.bg} 0%, color-mix(in srgb, ${c.bg} 70%, black) 100%)`,
      display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
      boxShadow: '0 4px 10px rgba(0,0,0,0.4), 0 1px 0 rgba(255,255,255,0.4) inset',
    }}>
      <span className="material-symbols-outlined ms-fill" style={{ fontSize: 18, color: c.fg }}>military_tech</span>
    </div>
  );
}

function RankingPanel() {
  const top = PARTICIPANTS.slice(0, 10);
  return (
    <div className="card" style={{
      gridColumn: 'span 8',
      padding: 0,
      borderRadius: 'var(--r-2xl)',
      overflow: 'hidden',
    }}>
      <div style={{
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        padding: '20px 26px',
        borderBottom: '1px solid var(--border-soft)',
      }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
          <div style={{
            width: 36, height: 36, borderRadius: 'var(--r-md)',
            background: 'rgba(242,201,76,0.10)',
            border: '1px solid rgba(242,201,76,0.30)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 20, color: '#FFD96B' }}>leaderboard</span>
          </div>
          <div>
            <div style={{ font: '700 16px/1 Inter', color: '#fff' }}>Ranking geral</div>
            <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
              Após 4 rodadas · 20 participantes
            </div>
          </div>
        </div>
        <div style={{ display: 'flex', gap: 6, padding: 4, background: 'rgba(255,255,255,0.04)', borderRadius: 'var(--r-pill)', border: '1px solid var(--border-medium)' }}>
          {['Geral', 'Esta semana', 'Por fase'].map((t, i) => (
            <button key={t} style={{
              height: 30, padding: '0 14px',
              borderRadius: 'var(--r-pill)',
              border: 'none',
              background: i === 0 ? 'rgba(255,255,255,0.08)' : 'transparent',
              color: i === 0 ? '#fff' : 'var(--fg-secondary)',
              font: '600 12.5px/1 Inter',
              cursor: 'pointer',
            }}>{t}</button>
          ))}
        </div>
      </div>

      {/* table header */}
      <div className="tbl-row" style={{
        gridTemplateColumns: '60px 1fr 100px 80px 90px 80px',
        padding: '12px 26px',
        background: 'rgba(255,255,255,0.02)',
        font: '600 10.5px/1 Inter',
        letterSpacing: '.12em',
        textTransform: 'uppercase',
        color: 'var(--fg-muted)',
        borderBottom: '1px solid var(--border-medium)',
      }}>
        <div>POS</div>
        <div>Participante</div>
        <div style={{ textAlign: 'right' }}>Total</div>
        <div style={{ textAlign: 'right' }}>Exato</div>
        <div style={{ textAlign: 'right' }}>Ganhador</div>
        <div style={{ textAlign: 'right' }}>Parcial</div>
      </div>

      {top.map((p, i) => {
        const pos = i + 1;
        return (
          <div key={p.name} className="tbl-row" style={{
            gridTemplateColumns: '60px 1fr 100px 80px 90px 80px',
            padding: '14px 26px',
            background: p.isMe ? 'rgba(31,214,107,0.06)' : 'transparent',
            position: 'relative',
          }}>
            {p.isMe && (
              <div style={{
                position: 'absolute', left: 0, top: 0, bottom: 0,
                width: 3, background: 'var(--br-green-bright)',
              }} />
            )}
            <div><MedalBadge pos={pos} /></div>
            <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
              <div style={{
                width: 34, height: 34, borderRadius: '50%',
                background: `linear-gradient(135deg, ${avatarGrad(i)})`,
                display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                font: '700 12px/1 Inter', color: '#fff',
                border: '1px solid var(--border-medium)',
              }}>{p.i}</div>
              <div>
                <div style={{ font: '600 14px/1 Inter', color: '#fff' }}>
                  {p.name}
                  {p.isMe && (
                    <span style={{
                      display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                      marginLeft: 8, padding: '2px 7px',
                      borderRadius: 'var(--r-pill)',
                      background: 'rgba(31,214,107,0.15)',
                      border: '1px solid rgba(31,214,107,0.40)',
                      font: '700 9.5px/1 Inter', letterSpacing: '.10em',
                      color: '#62F49B',
                    }}>VOCÊ</span>
                  )}
                </div>
                <div style={{ font: '500 11.5px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
                  {pos <= 3 ? `↑ ${[2,1,1][pos-1]} pos esta semana` : `${pos % 3 === 0 ? '↓' : '↑'} ${(pos % 3) + 1} pos`}
                </div>
              </div>
            </div>
            <div style={{ textAlign: 'right' }}>
              <span style={{
                font: '800 18px/1 Inter',
                color: pos === 1 ? '#FFD96B' : '#fff',
                fontVariantNumeric: 'tabular-nums',
              }}>{p.total}</span>
              <span style={{ font: '500 10px/1 Inter', color: 'var(--fg-muted)', marginLeft: 3 }}>pts</span>
            </div>
            <div style={{ textAlign: 'right', font: '600 14px/1 Inter', color: p.exato ? '#62F49B' : 'var(--fg-muted)', fontVariantNumeric: 'tabular-nums' }}>{p.exato}</div>
            <div style={{ textAlign: 'right', font: '600 14px/1 Inter', color: '#fff', fontVariantNumeric: 'tabular-nums' }}>{p.ganhador}</div>
            <div style={{ textAlign: 'right', font: '600 14px/1 Inter', color: 'var(--fg-secondary)', fontVariantNumeric: 'tabular-nums' }}>{p.parcial}</div>
          </div>
        );
      })}

      {/* mostrar mais */}
      <div style={{
        padding: '14px 26px',
        display: 'flex', justifyContent: 'space-between', alignItems: 'center',
        borderTop: '1px solid var(--border-soft)',
        background: 'rgba(255,255,255,0.02)',
      }}>
        <span style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)' }}>Mostrando 10 de 20 participantes</span>
        <button className="btn-ghost" style={{ height: 32, fontSize: 12 }}>
          Ver ranking completo
          <span className="material-symbols-outlined" style={{ fontSize: 16 }}>arrow_forward</span>
        </button>
      </div>
    </div>
  );
}

function avatarGrad(i) {
  const palette = [
    '#1FD66B 0%, #006B28 100%',
    '#FEDF00 0%, #C99A00 100%',
    '#002776 0%, #15205A 100%',
    '#FF7A8E 0%, #8C1F2F 100%',
    '#8EA9FF 0%, #2A3F8A 100%',
    '#FFB35A 0%, #C95F00 100%',
    '#62F49B 0%, #1A6E3E 100%',
    '#C8CDE4 0%, #5A607F 100%',
    '#F2C94C 0%, #8A5A00 100%',
    '#5BB4FF 0%, #1A4E80 100%',
  ];
  return palette[i % palette.length];
}

function LastResultPanel() {
  return (
    <div className="card" style={{
      gridColumn: 'span 4',
      padding: 0,
      borderRadius: 'var(--r-2xl)',
      overflow: 'hidden',
    }}>
      <div style={{
        padding: '20px 24px',
        borderBottom: '1px solid var(--border-soft)',
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
      }}>
        <div>
          <div style={{ font: '700 15px/1 Inter', color: '#fff' }}>Último resultado</div>
          <div style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)', marginTop: 5 }}>
            Grupo G · Rodada 3 · 11 jun
          </div>
        </div>
        <span className="chip green">
          <span style={{ width: 6, height: 6, borderRadius: 99, background: '#1FD66B' }} />
          Encerrado
        </span>
      </div>

      {/* placar oficial */}
      <div style={{
        padding: '24px 24px 18px',
        background: 'linear-gradient(180deg, rgba(0,156,59,0.08) 0%, transparent 100%)',
        display: 'grid', gridTemplateColumns: '1fr auto 1fr',
        alignItems: 'center', gap: 12,
      }}>
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 8 }}>
          <Flag code="BRA" size={48} />
          <div style={{ font: '700 13px/1 Inter', color: '#fff' }}>Brasil</div>
        </div>
        <div style={{
          display: 'flex', alignItems: 'center', gap: 8,
          font: '900 44px/1 Inter', letterSpacing: '-0.04em', color: '#fff',
          fontVariantNumeric: 'tabular-nums',
        }}>
          <span style={{ color: 'var(--br-yellow)' }}>2</span>
          <span style={{ color: 'var(--fg-faint)', fontSize: 28 }}>×</span>
          <span>1</span>
        </div>
        <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', gap: 8 }}>
          <Flag code="SUI" size={48} />
          <div style={{ font: '700 13px/1 Inter', color: '#fff' }}>Suíça</div>
        </div>
      </div>

      {/* Os melhores palpites */}
      <div style={{ padding: '18px 24px 22px' }}>
        <div style={{
          font: '600 10.5px/1 Inter', letterSpacing: '.14em', textTransform: 'uppercase',
          color: 'var(--fg-muted)', marginBottom: 12,
          display: 'flex', alignItems: 'center', gap: 8,
        }}>
          <span className="material-symbols-outlined" style={{ fontSize: 14, color: '#FFD96B' }}>auto_awesome</span>
          Melhores palpites · 3 acertos exatos
        </div>

        {[
          { i: 'CM', name: 'Camila Moraes', s: [2,1], pts: '+10', kind: 'exato' },
          { i: 'BR', name: 'Bruno Ramires', s: [2,1], pts: '+10', kind: 'exato' },
          { i: 'JR', name: 'Júlia Ribeiro', s: [2,1], pts: '+10', kind: 'exato' },
        ].map((p, i) => (
          <div key={p.name} style={{
            display: 'flex', alignItems: 'center', justifyContent: 'space-between',
            padding: '10px 0',
            borderBottom: i < 2 ? '1px solid var(--border-soft)' : 'none',
          }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 10 }}>
              <div style={{
                width: 28, height: 28, borderRadius: '50%',
                background: `linear-gradient(135deg, ${avatarGrad(i)})`,
                display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
                font: '700 10.5px/1 Inter', color: '#fff',
              }}>{p.i}</div>
              <div>
                <div style={{ font: '600 13px/1 Inter', color: '#fff' }}>{p.name}</div>
                <div style={{ font: '500 11px/1 Inter', color: 'var(--fg-muted)', marginTop: 4 }}>
                  Palpitou {p.s[0]}×{p.s[1]} · acerto exato
                </div>
              </div>
            </div>
            <div style={{
              display: 'inline-flex', alignItems: 'center', gap: 6,
              padding: '4px 10px',
              borderRadius: 'var(--r-pill)',
              background: 'rgba(31,214,107,0.12)',
              border: '1px solid rgba(31,214,107,0.30)',
              font: '700 12px/1 Inter', color: '#62F49B',
            }}>
              <span className="material-symbols-outlined" style={{ fontSize: 12 }}>trending_up</span>
              {p.pts}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

function MyStatsStrip() {
  const stats = [
    { label: 'Sua posição', value: '3º', delta: '↑ 2', deltaColor: '#62F49B', icon: 'workspace_premium' },
    { label: 'Seus pontos', value: '25', sub: '/ 28 do líder', icon: 'scoreboard' },
    { label: 'Palpites exatos', value: '1', sub: 'de 3 rodadas', icon: 'gps_fixed' },
    { label: 'Aproveitamento', value: '78%', sub: 'acertos parciais', icon: 'percent' },
  ];
  return (
    <div className="card" style={{
      gridColumn: 'span 12',
      padding: 20,
      borderRadius: 'var(--r-2xl)',
      display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: 0,
    }}>
      {stats.map((s, i) => (
        <div key={s.label} style={{
          display: 'flex', alignItems: 'center', gap: 14,
          padding: '4px 18px',
          borderLeft: i > 0 ? '1px solid var(--border-soft)' : 'none',
        }}>
          <div style={{
            width: 44, height: 44, borderRadius: 'var(--r-md)',
            background: 'rgba(254,223,0,0.08)',
            border: '1px solid rgba(254,223,0,0.20)',
            display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
          }}>
            <span className="material-symbols-outlined" style={{ fontSize: 22, color: 'var(--br-yellow)' }}>{s.icon}</span>
          </div>
          <div style={{ flex: 1 }}>
            <div style={{
              font: '600 11px/1 Inter', letterSpacing: '.12em', textTransform: 'uppercase',
              color: 'var(--fg-muted)', marginBottom: 8,
            }}>{s.label}</div>
            <div style={{ display: 'flex', alignItems: 'baseline', gap: 8 }}>
              <span style={{ font: '800 28px/1 Inter', letterSpacing: '-0.03em', color: '#fff' }}>{s.value}</span>
              {s.delta && (
                <span style={{ font: '600 12px/1 Inter', color: s.deltaColor }}>{s.delta}</span>
              )}
              {s.sub && (
                <span style={{ font: '500 12px/1 Inter', color: 'var(--fg-muted)' }}>{s.sub}</span>
              )}
            </div>
          </div>
        </div>
      ))}
    </div>
  );
}

function DashboardScreen() {
  return (
    <div className="app-root" style={{ background: 'var(--bg-base)' }}>
      <BrazilBgDeco intensity={0.7} />

      <div style={{ position: 'relative', zIndex: 2 }}>
        <TopNav active="dashboard" />

        <div style={{
          padding: '32px 32px 40px',
          display: 'grid', gridTemplateColumns: 'repeat(12, 1fr)',
          gap: 22,
          maxWidth: 1440, margin: '0 auto',
        }}>
          {/* Greeting strip */}
          <div style={{ gridColumn: '1 / -1', display: 'flex', alignItems: 'flex-end', justifyContent: 'space-between' }}>
            <div>
              <div style={{
                font: '600 11px/1 Inter', letterSpacing: '.16em', textTransform: 'uppercase',
                color: 'var(--br-yellow)', marginBottom: 12,
              }}>
                <span className="material-symbols-outlined" style={{ fontSize: 13, verticalAlign: '-2px', marginRight: 6 }}>waving_hand</span>
                Bom dia, Lucas
              </div>
              <h1 style={{
                margin: 0, font: '800 34px/1.1 Inter', letterSpacing: '-0.025em', color: '#fff',
              }}>
                Faltam <span style={{ color: 'var(--br-yellow)' }}>3 dias</span> pra você entrar pra história.
              </h1>
              <p style={{
                margin: '10px 0 0', font: '500 14px/1.5 Inter', color: 'var(--fg-secondary)', maxWidth: 600,
              }}>
                Brasil estreia no Grupo G contra Marrocos. O bolão segue acirrado — você está apenas 3 pontos atrás da liderança.
              </p>
            </div>
            <div style={{ display: 'flex', gap: 10 }}>
              <button className="btn-ghost" style={{ height: 40 }}>
                <span className="material-symbols-outlined" style={{ fontSize: 18 }}>menu_book</span>
                Regras do bolão
              </button>
              <button className="btn-ghost" style={{ height: 40 }}>
                <span className="material-symbols-outlined" style={{ fontSize: 18 }}>share</span>
                Convidar colega
              </button>
            </div>
          </div>

          <HeroNextMatch />
          <PrizeCard />
          <MyStatsStrip />
          <RankingPanel />
          <LastResultPanel />
        </div>
      </div>
    </div>
  );
}

Object.assign(window, { DashboardScreen, avatarGrad });
