import { publicUrl } from "../lib/publicAsset";

/** Public still URLs under `/wedding-frame/{n}.png` (Laravel `public/wedding-frame/`). */
export function getWeddingInvitationFrameUrl(n: number): string {
  return publicUrl(`wedding-frame/${n}.png`);
}

/** Cinematic intro: wide → mid → couple (1.png, 2.png, 3.png). */
export const WEDDING_INVITATION_CINEMATIC_URLS: readonly [string, string, string] = [
  getWeddingInvitationFrameUrl(1),
  getWeddingInvitationFrameUrl(2),
  getWeddingInvitationFrameUrl(3),
];

/** @deprecated Kept for compatibility; only first three frames are used in-app. */
export const WEDDING_INVITATION_FRAME_URLS: readonly string[] = WEDDING_INVITATION_CINEMATIC_URLS;

function loadImage(src: string): Promise<void> {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve();
    img.onerror = () => reject(new Error(`Failed to load ${src}`));
    img.src = src;
  });
}

/** All frames — used when every asset must be ready. */
export function preloadWeddingInvitationFrames(urls: readonly string[]): Promise<void> {
  return Promise.all(urls.map((src) => loadImage(src))).then(() => undefined);
}

/**
 * First cinematic still only (`urls[0]`) — fastest first paint; intro only shows 1.png.
 * Call `preloadWeddingInvitationFrames` in the background for the rest if needed.
 */
export function preloadWeddingInvitationHero(urls: readonly [string, string, string]): Promise<void> {
  return loadImage(urls[0]);
}
