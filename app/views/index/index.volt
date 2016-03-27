<!-- 1. Load libraries -->
{{ javascript_include("libs/es6-shim.min.js") }}
{{ javascript_include("libs/system-polyfills.js") }}
{{ javascript_include("libs/Reflect.js") }}
{{ javascript_include("libs/shims_for_IE.js") }}
{{ javascript_include("libs/system.js") }}
{{ javascript_include("libs/rx.js") }}
{{ javascript_include("libs/zone.js") }}
{{ javascript_include("libs/angular2.dev.js") }}
{{ javascript_include("libs/router.dev.js") }}
{{ javascript_include("libs/http.dev.js") }}

<script>
    System.config({
        packages: {
            js: {
                defaultExtension: 'js'
            }
        }
    });
</script>
<script>
    System.import('js/boot')
            .then(null, console.error.bind(console));
</script>

<my-gallery>Loading...</my-gallery>