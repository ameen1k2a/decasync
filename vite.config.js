/* import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
 */

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', // Keep this if app.css is needed
                'resources/js/app.js',   // Keep this if app.js is needed
                // Add your CSS files
                'resources/assets/css/bootstrap.min.css',
                'resources/assets/css/quicksand.css',
                'resources/assets/css/style.css',
                'resources/assets/css/fontawesome-all.min.css',
                'resources/assets/css/fontawesome.css',
                'resources/assets/css/animate.min.css',
                'resources/assets/css/chartist.min.css',
                'resources/assets/css/jquery-jvectormap-2.0.2.css',
                'resources/assets/css/bootstrap_calendar.css',
                'resources/assets/css/nice-select.css',
                // Add your JS files
                'resources/assets/js/jquery.min.js',
                'resources/assets/js/jquery-1.12.4.min.js',
                'resources/assets/js/popper.min.js',
                'resources/assets/js/bootstrap.min.js',
                'resources/assets/js/sweetalert.js',
                'resources/assets/js/progressbar.min.js',
                'resources/assets/js/jquery.flot.min.js',
                'resources/assets/js/jquery.flot.pie.min.js',
                'resources/assets/js/jquery.flot.categories.min.js',
                'resources/assets/js/jquery.flot.stack.min.js',
                'resources/assets/js/chart.min.js',
                'resources/assets/js/chartist.min.js',
                'resources/assets/js/chartist-data.js',
                'resources/assets/js/demo.js',
                'resources/assets/js/jquery-jvectormap-2.0.2.min.js',
                'resources/assets/js/jquery-jvectormap-world-mill-en.js',
                'resources/assets/js/jvector-maps.js',
                'resources/assets/js/bootstrap_calendar.js',
                'resources/assets/js/nice-select.min.js',
                'resources/assets/js/custom.js',
            ],
            refresh: true,
        }),
    ],
});
