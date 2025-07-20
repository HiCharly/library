import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import lineClamp from '@tailwindcss/line-clamp';

export default defineConfig({
  plugins: [
    tailwindcss({
      plugins: [lineClamp]
    })
  ]
});
