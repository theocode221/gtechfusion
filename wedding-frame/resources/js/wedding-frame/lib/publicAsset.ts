/**
 * URL for files in Laravel `public/` (e.g. `wedding-frame/song.mp3`).
 *
 * Do not use `import.meta.env.BASE_URL` here: the Laravel Vite plugin sets `base` to `""`
 * in dev (breaking relative paths on nested routes) and to `…/build/` in production (wrong
 * for static files that live beside `build/`, not inside it).
 */
export function publicUrl(path: string): string {
  const p = path.replace(/^\/+/, "");
  return `/${p}`;
}
