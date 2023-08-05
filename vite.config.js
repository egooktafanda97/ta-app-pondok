import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "datatables.net-responsive":
                "node_modules/datatables.net-responsive/js/dataTables.responsive.min.js",
        },
    },
});
