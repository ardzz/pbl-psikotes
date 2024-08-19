import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './node_modules/flowbite/**/*.js',
        './vendor/jaocero/filachat/resources/views/**/**/*.blade.php',
        './vendor/laravel/pulse/resources/views/**/*.blade.php',
    ],
    plugins: [
        require('flowbite/plugin')
    ],
}
