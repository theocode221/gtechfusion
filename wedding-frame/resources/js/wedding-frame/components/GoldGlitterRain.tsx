import { useMemo, type CSSProperties } from "react";
import "../styles/gold-glitter.css";

export type GoldGlitterVariant = "viewport" | "card";

const PARTICLE_COUNT_VIEWPORT = 140;
const PARTICLE_COUNT_CARD = 96;

type Particle = {
  id: number;
  left: string;
  delay: string;
  duration: string;
  width: string;
  height: string;
  drift: string;
};

type GoldGlitterRainProps = {
  /** `viewport` = full screen; `card` = clipped behind invitation details */
  variant?: GoldGlitterVariant;
};

export function GoldGlitterRain({ variant = "viewport" }: GoldGlitterRainProps) {
  const particles = useMemo<Particle[]>(() => {
    const count = variant === "card" ? PARTICLE_COUNT_CARD : PARTICLE_COUNT_VIEWPORT;
    return Array.from({ length: count }, (_, i) => ({
      id: i,
      left: `${Math.random() * 100}%`,
      delay: `${Math.random() * (variant === "card" ? 8 : 12)}s`,
      duration:
        variant === "card"
          ? `${6.5 + Math.random() * 7.5}s`
          : `${9 + Math.random() * 10}s`,
      width:
        variant === "card"
          ? `${1.2 + Math.random() * 2.8}px`
          : `${1.5 + Math.random() * 3.5}px`,
      height:
        variant === "card"
          ? `${1.2 + Math.random() * 2.8}px`
          : `${1.5 + Math.random() * 3.5}px`,
      drift:
        variant === "card"
          ? `${-10 + Math.random() * 20}px`
          : `${-40 + Math.random() * 80}px`,
    }));
  }, [variant]);

  const rootClass =
    variant === "card"
      ? "ggr-root ggr-root--card"
      : "ggr-root ggr-root--viewport";

  return (
    <div className={rootClass} aria-hidden>
      {particles.map((p) => (
        <span
          key={p.id}
          className="ggr-particle"
          style={
            {
              "--ggr-left": p.left,
              "--ggr-delay": p.delay,
              "--ggr-dur": p.duration,
              "--ggr-w": p.width,
              "--ggr-h": p.height,
              "--ggr-drift": p.drift,
            } as CSSProperties
          }
        />
      ))}
    </div>
  );
}
