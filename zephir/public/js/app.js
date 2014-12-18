(function() {
  var HomePage;

  HomePage = (function() {
    function HomePage() {}

    HomePage.prototype.index = function() {};

    return HomePage;

  })();

  window.HomePage = HomePage;

}).call(this);

(function() {
  var IndexPage;

  IndexPage = (function() {
    function IndexPage() {}

    IndexPage.prototype.index = function() {};

    return IndexPage;

  })();

  window.IndexPage = IndexPage;

}).call(this);

(function() {
  $(function() {
    var router;
    router = new Router();
    return router.follow();
  });

}).call(this);

(function() {
  var DialogBox;

  DialogBox = (function() {
    function DialogBox(name, template, opts) {
      this.name = name;
      this.template = template;
      this.opts = opts != null ? opts : {
        close: true,
        drag: false
      };
      this.canBeClose = this.opts.close;
      this.canBeDrag = this.opts.drag;
    }

    DialogBox.prototype.load = function(callback) {
      var gateway;
      $("#overlay-black").show();
      gateway = new Gateway();
      return gateway.request("/zephir/app/templates/dialogs/" + this.template + ".html", {}, (function(_this) {
        return function(data) {
          var c, closeBt;
          _this.d = document.createElement('div');
          c = document.createElement('div');
          $(c).addClass("container");
          $(_this.d).addClass("dialog-box").append(c);
          if (_this.canBeClose) {
            closeBt = $(document.createElement('div')).addClass('close-bt');
            $(_this.d).append(closeBt);
            $(closeBt).click(function() {
              return _this.hide();
            });
          }
          $(c).append(data);
          $("#overlay-black").append(_this.d);
          return callback(data);
        };
      })(this));
    };

    DialogBox.prototype.hide = function() {
      $(this.d).hide();
      $(this.d).remove();
      return $("#overlay-black").hide();
    };

    return DialogBox;

  })();

  window.DialogBox = DialogBox;

}).call(this);

(function() {
  var Gateway;

  Gateway = (function() {
    function Gateway() {
      this.baseUrl = "/" + document.location.pathname.split('/')[1];
    }

    Gateway.prototype.request = function(target, params, callback) {
      return $.post(this.baseUrl + target, params).done((function(_this) {
        return function(data) {
          return callback(data);
        };
      })(this));
    };

    Gateway.prototype.requestJSON = function(target, params, callback) {
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
