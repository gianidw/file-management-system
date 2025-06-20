(function (global, factory) {
  if (typeof define === "function" && define.amd) {
    define('/Component', ['exports', 'jquery'], factory);
  } else if (typeof exports !== "undefined") {
    factory(exports, require('jquery'));
  } else {
    var mod = {
      exports: {}
    };
    factory(mod.exports, global.jQuery);
    global.Component = mod.exports;
  }
})(this, function (exports, _jquery) {
  'use strict';

  Object.defineProperty(exports, "__esModule", {
    value: true
  });

  var _jquery2 = babelHelpers.interopRequireDefault(_jquery);

  if (typeof Object.assign === 'undefined') {
    Object.assign = _jquery2.default.extend;
  }
  var Component = function () {
    function Component() {
      var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
      babelHelpers.classCallCheck(this, Component);

      this.$el = options.$el ? options.$el : (0, _jquery2.default)(document);
      this.el = this.$el[0];
      delete options.$el;

      this.options = options;
      this.isProcessed = false;
    }

    babelHelpers.createClass(Component, [{
      key: 'initialize',
      value: function initialize() {
        // Initialize the Component
      }
    }, {
      key: 'process',
      value: function process() {
        // Bind the Event on the Component
      }
    }, {
      key: 'run',
      value: function run() {
        // run Component
        if (!this.isProcessed) {
          this.initialize();
          this.process();
        }

        this.isProcessed = true;
      }
    }, {
      key: 'triggerResize',
      value: function triggerResize() {
        if (document.createEvent) {
          var ev = document.createEvent('Event');
          ev.initEvent('resize', true, true);
          window.dispatchEvent(ev);
        } else {
          element = document.documentElement;
          var event = document.createEventObject();
          element.fireEvent('onresize', event);
        }
      }
    }]);
    return Component;
  }();

  exports.default = Component;
});