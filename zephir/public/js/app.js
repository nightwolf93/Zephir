(function() {
  $(function() {
    var router;
    router = new Router();
    router.follow();
    return console.log(router);
  });

}).call(this);

(function() {
  var Gateway;

  Gateway = (function() {
    function Gateway() {
      this.baseUrl = '/Zomie-Ogame';
    }

    Gateway.prototype.request = function(target, params, callback) {
      return $.post(this.baseUrl + target, params).done((function(_this) {
        return function(data) {
          return callback(JSON.parse(data));
        };
      })(this));
    };

    Gateway.prototype.timedRequest = function(target, params, interval, callback) {
      return setInterval((function(_this) {
        return function() {
          return $.post(_this.baseUrl + target, params).done(function(data) {
            return callback(JSON.parse(data));
          });
        };
      })(this), interval);
    };

    Gateway.prototype.template = function(target, params, template, callback) {
      return $.post(this.baseUrl + target, params).done((function(_this) {
        return function(data) {
          var html, source;
          data = JSON.parse(data);
          source = $("#" + template).html();
          template = Handlebars.compile(source);
          html = template(data);
          return callback(html);
        };
      })(this));
    };

    return Gateway;

  })();

  window.Gateway = Gateway;

}).call(this);

(function() {
  var Router;

  Router = (function() {
    function Router() {
      this.route = document.location.pathname.substring(1);
      this.basePath = 1;
    }

    Router.prototype.follow = function() {
      var instance, paths;
      paths = this.route.split('/').splice(this.basePath, this.route.split('/').length);
      if (paths.length > 0 && paths[0] !== "") {
        instance = new window[paths[0].charAt(0).toUpperCase() + paths[0].substring(1).toLowerCase() + "Page"]();
        if (paths.length > 1) {
          return instance[paths[1].toLowerCase()]();
        } else {
          return instance['index']();
        }
      } else {
        instance = new window["IndexPage"]();
        return instance.index();
      }
    };

    return Router;

  })();

  window.Router = Router;

}).call(this);

(function() {
  var HomePage;

  HomePage = (function() {
    function HomePage() {}

    HomePage.prototype.index = function() {
      return console.log('home');
    };

    HomePage.prototype.test = function() {
      return console.log('test');
    };

    return HomePage;

  })();

  window.HomePage = HomePage;

}).call(this);

(function() {
  var IndexPage;

  IndexPage = (function() {
    function IndexPage() {}

    IndexPage.prototype.index = function() {
      return console.log('index');
    };

    return IndexPage;

  })();

  window.IndexPage = IndexPage;

}).call(this);
