// vite.config.mjs
import { defineConfig } from "file:///C:/xampp/htdocs/eascencia/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/xampp/htdocs/eascencia/node_modules/laravel-vite-plugin/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.js", "resources/css/app.css"],
      refresh: true
    })
  ],
  server: {
    host: process.env.APP_URL,
    // Use APP_URL from .env
    port: 5173,
    // Default Vite port
    hmr: {
      protocol: "ws",
      // or 'wss' for secure
      host: process.env.APP_URL
      // Use APP_URL from .env
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcubWpzIl0sCiAgInNvdXJjZXNDb250ZW50IjogWyJjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZGlybmFtZSA9IFwiQzpcXFxceGFtcHBcXFxcaHRkb2NzXFxcXGVhc2NlbmNpYVwiO2NvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9maWxlbmFtZSA9IFwiQzpcXFxceGFtcHBcXFxcaHRkb2NzXFxcXGVhc2NlbmNpYVxcXFx2aXRlLmNvbmZpZy5tanNcIjtjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfaW1wb3J0X21ldGFfdXJsID0gXCJmaWxlOi8vL0M6L3hhbXBwL2h0ZG9jcy9lYXNjZW5jaWEvdml0ZS5jb25maWcubWpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XHJcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xyXG5cclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcclxuICAgIHBsdWdpbnM6IFtcclxuICAgICAgICBsYXJhdmVsKHtcclxuICAgICAgICAgICAgaW5wdXQ6IFsncmVzb3VyY2VzL2pzL2FwcC5qcycsICdyZXNvdXJjZXMvY3NzL2FwcC5jc3MnXSxcclxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcclxuICAgICAgICB9KSxcclxuICAgIF0sXHJcbiAgICBzZXJ2ZXI6IHtcclxuICAgICAgICBob3N0OiBwcm9jZXNzLmVudi5BUFBfVVJMLCAvLyBVc2UgQVBQX1VSTCBmcm9tIC5lbnZcclxuICAgICAgICBwb3J0OiA1MTczLCAvLyBEZWZhdWx0IFZpdGUgcG9ydFxyXG4gICAgICAgIGhtcjoge1xyXG4gICAgICAgICAgICBwcm90b2NvbDogJ3dzJywgLy8gb3IgJ3dzcycgZm9yIHNlY3VyZVxyXG4gICAgICAgICAgICBob3N0OiBwcm9jZXNzLmVudi5BUFBfVVJMLCAvLyBVc2UgQVBQX1VSTCBmcm9tIC5lbnZcclxuICAgICAgICB9LFxyXG4gICAgfSxcclxufSk7XHJcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBdVEsU0FBUyxvQkFBb0I7QUFDcFMsT0FBTyxhQUFhO0FBRXBCLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU8sQ0FBQyx1QkFBdUIsdUJBQXVCO0FBQUEsTUFDdEQsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLFFBQVE7QUFBQSxJQUNKLE1BQU0sUUFBUSxJQUFJO0FBQUE7QUFBQSxJQUNsQixNQUFNO0FBQUE7QUFBQSxJQUNOLEtBQUs7QUFBQSxNQUNELFVBQVU7QUFBQTtBQUFBLE1BQ1YsTUFBTSxRQUFRLElBQUk7QUFBQTtBQUFBLElBQ3RCO0FBQUEsRUFDSjtBQUNKLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
