const browserSync = require('browser-sync');
const gulp = require('gulp');
const connectPHP = require('gulp-connect-php');

// Create server
function serve() {
  connectPHP.server(
    {
      // A standalone PHP server that
      // browserSync connects to via proxy
      port: 8085,
      keepalive: true,
      base: './'
    },
    function() {
      browserSync({
        proxy: '127.0.0.1:8085'
      });
    }
  );
}

// BrowserSync Reload
function browserSyncReload(done) {
  browserSync.reload();
  done();
}

// Watch files
function watch() {
  gulp.watch('./**/*.php', browserSyncReload);
}

exports.default = gulp.parallel([watch, serve]);
