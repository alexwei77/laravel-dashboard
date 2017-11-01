(function(name, definition) {
    if (typeof module != 'undefined') {
      module.exports = definition();
    } else if (typeof define == 'function' && typeof define.amd == 'object') {
      define(definition);
    } else {
      this[name] = definition();
    }
  }('Router', function() {
  return {
    routes: [{"uri":"admin\/secureImage","name":"secureImage"},{"uri":"admin\/{id}\/lockscreen","name":"lockscreen"},{"uri":"admin\/{id}\/lockscreen","name":"lockscreen"},{"uri":"admin\/signin","name":"signin"},{"uri":"admin\/signup","name":"signup"},{"uri":"admin\/forgot-password","name":"forgot-password"},{"uri":"admin\/register2","name":"register2"},{"uri":"admin\/forgot-password\/{userId}\/{passwordResetCode}","name":"forgot-password-confirm"},{"uri":"admin\/logout","name":"logout"},{"uri":"admin\/activate\/{userId}\/{activationCode}","name":"activate"},{"uri":"admin","name":"admin.dashboard"},{"uri":"admin\/generator_builder","name":"admin."},{"uri":"admin\/field_template","name":"admin."},{"uri":"admin\/generator_builder\/generate","name":"admin."},{"uri":"admin\/users","name":"admin.users.index"},{"uri":"admin\/users\/data","name":"admin.users.data"},{"uri":"admin\/users\/create","name":"admin.users.create"},{"uri":"admin\/users\/create","name":"admin."},{"uri":"admin\/users\/{user}\/delete","name":"admin.users.delete"},{"uri":"admin\/users\/{user}\/confirm-delete","name":"admin.users.confirm-delete"},{"uri":"admin\/users\/{user}\/restore","name":"admin.restore\/user"},{"uri":"admin\/users\/{user}","name":"admin.users.show"},{"uri":"admin\/users\/{user}\/passwordreset","name":"admin.passwordreset"},{"uri":"admin\/users","name":"admin.users.store"},{"uri":"admin\/users\/{user}\/edit","name":"admin.users.edit"},{"uri":"admin\/users\/{user}","name":"admin.users.update"},{"uri":"admin\/users\/{user}","name":"admin.users.destroy"},{"uri":"admin\/deleted_users","name":"admin.deleted_users"},{"uri":"admin\/groups","name":"admin.groups"},{"uri":"admin\/groups\/create","name":"admin.groups.create"},{"uri":"admin\/groups\/create","name":"admin."},{"uri":"admin\/groups\/{group}\/edit","name":"admin.groups.edit"},{"uri":"admin\/groups\/{group}\/edit","name":"admin."},{"uri":"admin\/groups\/{group}\/delete","name":"admin.groups.delete"},{"uri":"admin\/groups\/{group}\/confirm-delete","name":"admin.groups.confirm-delete"},{"uri":"admin\/groups\/{group}\/restore","name":"admin.groups.restore"},{"uri":"admin\/blog","name":"admin.blogs"},{"uri":"admin\/blog\/create","name":"admin.blog.create"},{"uri":"admin\/blog\/create","name":"admin."},{"uri":"admin\/blog\/{blog}\/edit","name":"admin.blog.edit"},{"uri":"admin\/blog\/{blog}\/edit","name":"admin."},{"uri":"admin\/blog\/{blog}\/delete","name":"admin.blog.delete"},{"uri":"admin\/blog\/{blog}\/confirm-delete","name":"admin.blog.confirm-delete"},{"uri":"admin\/blog\/{blog}\/restore","name":"admin.blog.restore"},{"uri":"admin\/blog\/{blog}\/show","name":"admin.blog.show"},{"uri":"admin\/blog\/{blog}\/storecomment","name":"admin."},{"uri":"admin\/blogcategory","name":"admin.blogcategories"},{"uri":"admin\/blogcategory\/create","name":"admin.blogcategory.create"},{"uri":"admin\/blogcategory\/create","name":"admin."},{"uri":"admin\/blogcategory\/{blogCategory}\/edit","name":"admin.blogcategory.edit"},{"uri":"admin\/blogcategory\/{blogCategory}\/edit","name":"admin."},{"uri":"admin\/blogcategory\/{blogCategory}\/delete","name":"admin.blogcategory.delete"},{"uri":"admin\/blogcategory\/{blogCategory}\/confirm-delete","name":"admin.blogcategory.confirm-delete"},{"uri":"admin\/blogcategory\/{blogCategory}\/restore","name":"admin.blogcategory.restore"},{"uri":"admin\/file\/create","name":"admin."},{"uri":"admin\/file\/createmulti","name":"admin."},{"uri":"admin\/file\/delete","name":"admin."},{"uri":"admin\/crop_demo","name":"admin."},{"uri":"admin\/crop_demo","name":"admin."},{"uri":"admin\/datatables","name":"admin."},{"uri":"admin\/datatables\/data","name":"admin.datatables.data"},{"uri":"admin\/editable_datatables","name":"admin."},{"uri":"admin\/editable_datatables\/data","name":"admin.editable_datatables.data"},{"uri":"admin\/editable_datatables\/create","name":"admin."},{"uri":"admin\/editable_datatables\/{id}\/update","name":"admin."},{"uri":"admin\/editable_datatables\/{id}\/delete","name":"admin.admin.editable_datatables.delete"},{"uri":"admin\/custom_datatables","name":"admin."},{"uri":"admin\/custom_datatables\/sliderData","name":"admin.admin.custom_datatables.sliderData"},{"uri":"admin\/custom_datatables\/radioData","name":"admin.admin.custom_datatables.radioData"},{"uri":"admin\/custom_datatables\/selectData","name":"admin.admin.custom_datatables.selectData"},{"uri":"admin\/custom_datatables\/buttonData","name":"admin.admin.custom_datatables.buttonData"},{"uri":"admin\/custom_datatables\/totalData","name":"admin.admin.custom_datatables.totalData"},{"uri":"admin\/task\/create","name":"admin."},{"uri":"admin\/task\/data","name":"admin."},{"uri":"admin\/task\/{task}\/edit","name":"admin."},{"uri":"admin\/task\/{task}\/delete","name":"admin."},{"uri":"admin\/{name?}","name":"admin."},{"uri":"login","name":"login"},{"uri":"register","name":"register"},{"uri":"activate\/{userId}\/{activationCode}","name":"activate"},{"uri":"forgot-password","name":"forgot-password"},{"uri":"forgot-password\/{userId}\/{passwordResetCode}","name":"forgot-password-confirm"},{"uri":"my-account","name":"my-account"},{"uri":"subscribe","name":"subscribe"},{"uri":"invite","name":"invite"},{"uri":"create-rating","name":"create-rating"},{"uri":"all-ratings","name":"all-ratings"},{"uri":"logout","name":"logout"},{"uri":"contact","name":"contact"},{"uri":"\/","name":"home"},{"uri":"blog","name":"blog"},{"uri":"_debugbar\/open","name":"debugbar.openhandler"},{"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork"},{"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css"},{"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js"}],
    route: function(name, params) {
      var route = this.searchRoute(name),
          rootUrl = this.getRootUrl(),
          result = "",
          compiled = "";

      if (route) {
        compiled = this.buildParams(route, params);
        result = this.cleanupDoubleSlashes(rootUrl + '/' + compiled);
        result = this.stripTrailingSlash(result);
        return result;
      }

    },
    searchRoute: function(name) {
      for (var i = this.routes.length - 1; i >= 0; i--) {
        if (this.routes[i].name == name) {
          return this.routes[i];
        }
      }
    },
    buildParams: function(route, params) {
      var compiled = route.uri,
          queryParams = {};

      for (var key in params) {
        if (compiled.indexOf('{' + key + '?}') != -1) {
          if (key in params) {
            compiled = compiled.replace('{' + key + '?}', params[key]);
          }
        } else if (compiled.indexOf('{' + key + '}') != -1) {
          compiled = compiled.replace('{' + key + '}', params[key]);
        } else {
          queryParams[key] = params[key];
        }
      }

      compiled = compiled.replace(/\{([^\/]*)\?}/g, "");

      if (!this.isEmptyObject(queryParams)) {
        return compiled + this.buildQueryString(queryParams);
      }

      return compiled;
    },
    getRootUrl: function() {
      return window.location.protocol + '//' + window.location.host;
    },
    buildQueryString: function(params) {
      var ret = [];
      for (var key in params) {
        ret.push(encodeURIComponent(key) + "=" + encodeURIComponent(params[key]));
      }
      return '?' + ret.join("&");
    },
    isEmptyObject: function(obj) {
      var name;
      for (name in obj) {
        return false;
      }
      return true;
    },
    cleanupDoubleSlashes: function(url) {
      return url.replace(/([^:]\/)\/+/g, "$1");
    },
    stripTrailingSlash: function(url) {
      if(url.substr(-1) == '/') {
        return url.substr(0, url.length - 1);
      }
      return url;
    }
  };
}));