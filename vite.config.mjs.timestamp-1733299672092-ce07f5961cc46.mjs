// vite.config.mjs
import { defineConfig } from "file:///C:/xampp/htdocs/eascencia/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/xampp/htdocs/eascencia/node_modules/laravel-vite-plugin/dist/index.js";
import dotenv from "file:///C:/xampp/htdocs/eascencia/node_modules/dotenv/lib/main.js";
dotenv.config();
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.js", "resources/css/app.css"],
      refresh: true
    })
  ],
  server: {
    host: process.env.VITE_URL,
    // Use APP_URL from .env
    port: 5173,
    // Default Vite port
    hmr: {
      protocol: "ws",
      // or 'wss' for secure
      host: process.env.VITE_URL
      // Use APP_URL from .env
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcubWpzIl0sCiAgInNvdXJjZXNDb250ZW50IjogWyJjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZGlybmFtZSA9IFwiQzpcXFxceGFtcHBcXFxcaHRkb2NzXFxcXGVhc2NlbmNpYVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxceGFtcHBcXFxcaHRkb2NzXFxcXGVhc2NlbmNpYVxcXFx2aXRlLmNvbmZpZy5tanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L3hhbXBwL2h0ZG9jcy9lYXNjZW5jaWEvdml0ZS5jb25maWcubWpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XHJcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xyXG5pbXBvcnQgZG90ZW52IGZyb20gJ2RvdGVudic7XHJcblxyXG5kb3RlbnYuY29uZmlnKCk7XHJcbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XHJcbiAgICBwbHVnaW5zOiBbXHJcbiAgICAgICAgbGFyYXZlbCh7XHJcbiAgICAgICAgICAgIGlucHV0OiBbJ3Jlc291cmNlcy9qcy9hcHAuanMnLCAncmVzb3VyY2VzL2Nzcy9hcHAuY3NzJ10sXHJcbiAgICAgICAgICAgIHJlZnJlc2g6IHRydWUsXHJcbiAgICAgICAgfSksXHJcbiAgICBdLFxyXG4gICAgc2VydmVyOiB7XHJcbiAgICAgICAgaG9zdDogcHJvY2Vzcy5lbnYuQVBQX1VSTF9XSVRIT1VUX1BPUlQsIC8vIFVzZSBBUFBfVVJMIGZyb20gLmVudlxyXG4gICAgICAgIHBvcnQ6IDUxNzMsIC8vIERlZmF1bHQgVml0ZSBwb3J0XHJcbiAgICAgICAgaG1yOiB7XHJcbiAgICAgICAgICAgIHByb3RvY29sOiAnd3MnLCAvLyBvciAnd3NzJyBmb3Igc2VjdXJlXHJcbiAgICAgICAgICAgIGhvc3Q6IHByb2Nlc3MuZW52LkFQUF9VUkxfV0lUSE9VVF9QT1JULCAvLyBVc2UgQVBQX1VSTCBmcm9tIC5lbnZcclxuICAgICAgICB9LFxyXG4gICAgfSxcclxufSk7XHJcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBdVEsU0FBUyxvQkFBb0I7QUFDcFMsT0FBTyxhQUFhO0FBQ3BCLE9BQU8sWUFBWTtBQUVuQixPQUFPLE9BQU87QUFDZCxJQUFPLHNCQUFRLGFBQWE7QUFBQSxFQUN4QixTQUFTO0FBQUEsSUFDTCxRQUFRO0FBQUEsTUFDSixPQUFPLENBQUMsdUJBQXVCLHVCQUF1QjtBQUFBLE1BQ3RELFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxFQUNMO0FBQUEsRUFDQSxRQUFRO0FBQUEsSUFDSixNQUFNLFFBQVEsSUFBSTtBQUFBO0FBQUEsSUFDbEIsTUFBTTtBQUFBO0FBQUEsSUFDTixLQUFLO0FBQUEsTUFDRCxVQUFVO0FBQUE7QUFBQSxNQUNWLE1BQU0sUUFBUSxJQUFJO0FBQUE7QUFBQSxJQUN0QjtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
