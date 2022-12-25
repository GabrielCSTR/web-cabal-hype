/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/alpinejs/dist/alpine.js":
/*!**********************************************!*\
  !*** ./node_modules/alpinejs/dist/alpine.js ***!
  \**********************************************/
/***/ (function(module) {

(function (global, factory) {
   true ? module.exports = factory() :
  0;
}(this, (function () { 'use strict';

  function _defineProperty(obj, key, value) {
    if (key in obj) {
      Object.defineProperty(obj, key, {
        value: value,
        enumerable: true,
        configurable: true,
        writable: true
      });
    } else {
      obj[key] = value;
    }

    return obj;
  }

  function ownKeys(object, enumerableOnly) {
    var keys = Object.keys(object);

    if (Object.getOwnPropertySymbols) {
      var symbols = Object.getOwnPropertySymbols(object);
      if (enumerableOnly) symbols = symbols.filter(function (sym) {
        return Object.getOwnPropertyDescriptor(object, sym).enumerable;
      });
      keys.push.apply(keys, symbols);
    }

    return keys;
  }

  function _objectSpread2(target) {
    for (var i = 1; i < arguments.length; i++) {
      var source = arguments[i] != null ? arguments[i] : {};

      if (i % 2) {
        ownKeys(Object(source), true).forEach(function (key) {
          _defineProperty(target, key, source[key]);
        });
      } else if (Object.getOwnPropertyDescriptors) {
        Object.defineProperties(target, Object.getOwnPropertyDescriptors(source));
      } else {
        ownKeys(Object(source)).forEach(function (key) {
          Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
        });
      }
    }

    return target;
  }

  // Thanks @stimulus:
  // https://github.com/stimulusjs/stimulus/blob/master/packages/%40stimulus/core/src/application.ts
  function domReady() {
    return new Promise(resolve => {
      if (document.readyState == "loading") {
        document.addEventListener("DOMContentLoaded", resolve);
      } else {
        resolve();
      }
    });
  }
  function arrayUnique(array) {
    return Array.from(new Set(array));
  }
  function isTesting() {
    return navigator.userAgent.includes("Node.js") || navigator.userAgent.includes("jsdom");
  }
  function checkedAttrLooseCompare(valueA, valueB) {
    return valueA == valueB;
  }
  function warnIfMalformedTemplate(el, directive) {
    if (el.tagName.toLowerCase() !== 'template') {
      console.warn(`Alpine: [${directive}] directive should only be added to <template> tags. See https://github.com/alpinejs/alpine#${directive}`);
    } else if (el.content.childElementCount !== 1) {
      console.warn(`Alpine: <template> tag with [${directive}] encountered with an unexpected number of root elements. Make sure <template> has a single root element. `);
    }
  }
  function kebabCase(subject) {
    return subject.replace(/([a-z])([A-Z])/g, '$1-$2').replace(/[_\s]/, '-').toLowerCase();
  }
  function camelCase(subject) {
    return subject.toLowerCase().replace(/-(\w)/g, (match, char) => char.toUpperCase());
  }
  function walk(el, callback) {
    if (callback(el) === false) return;
    let node = el.firstElementChild;

    while (node) {
      walk(node, callback);
      node = node.nextElementSibling;
    }
  }
  function debounce(func, wait) {
    var timeout;
    return function () {
      var context = this,
          args = arguments;

      var later = function later() {
        timeout = null;
        func.apply(context, args);
      };

      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  const handleError = (el, expression, error) => {
    console.warn(`Alpine Error: "${error}"\n\nExpression: "${expression}"\nElement:`, el);

    if (!isTesting()) {
      Object.assign(error, {
        el,
        expression
      });
      throw error;
    }
  };

  function tryCatch(cb, {
    el,
    expression
  }) {
    try {
      const value = cb();
      return value instanceof Promise ? value.catch(e => handleError(el, expression, e)) : value;
    } catch (e) {
      handleError(el, expression, e);
    }
  }

  function saferEval(el, expression, dataContext, additionalHelperVariables = {}) {
    return tryCatch(() => {
      if (typeof expression === 'function') {
        return expression.call(dataContext);
      }

      return new Function(['$data', ...Object.keys(additionalHelperVariables)], `var __alpine_result; with($data) { __alpine_result = ${expression} }; return __alpine_result`)(dataContext, ...Object.values(additionalHelperVariables));
    }, {
      el,
      expression
    });
  }
  function saferEvalNoReturn(el, expression, dataContext, additionalHelperVariables = {}) {
    return tryCatch(() => {
      if (typeof expression === 'function') {
        return Promise.resolve(expression.call(dataContext, additionalHelperVariables['$event']));
      }

      let AsyncFunction = Function;
      /* MODERN-ONLY:START */

      AsyncFunction = Object.getPrototypeOf(async function () {}).constructor;
      /* MODERN-ONLY:END */
      // For the cases when users pass only a function reference to the caller: `x-on:click="foo"`
      // Where "foo" is a function. Also, we'll pass the function the event instance when we call it.

      if (Object.keys(dataContext).includes(expression)) {
        let methodReference = new Function(['dataContext', ...Object.keys(additionalHelperVariables)], `with(dataContext) { return ${expression} }`)(dataContext, ...Object.values(additionalHelperVariables));

        if (typeof methodReference === 'function') {
          return Promise.resolve(methodReference.call(dataContext, additionalHelperVariables['$event']));
        } else {
          return Promise.resolve();
        }
      }

      return Promise.resolve(new AsyncFunction(['dataContext', ...Object.keys(additionalHelperVariables)], `with(dataContext) { ${expression} }`)(dataContext, ...Object.values(additionalHelperVariables)));
    }, {
      el,
      expression
    });
  }
  const xAttrRE = /^x-(on|bind|data|text|html|model|if|for|show|cloak|transition|ref|spread)\b/;
  function isXAttr(attr) {
    const name = replaceAtAndColonWithStandardSyntax(attr.name);
    return xAttrRE.test(name);
  }
  function getXAttrs(el, component, type) {
    let directives = Array.from(el.attributes).filter(isXAttr).map(parseHtmlAttribute); // Get an object of directives from x-spread.

    let spreadDirective = directives.filter(directive => directive.type === 'spread')[0];

    if (spreadDirective) {
      let spreadObject = saferEval(el, spreadDirective.expression, component.$data); // Add x-spread directives to the pile of existing directives.

      directives = directives.concat(Object.entries(spreadObject).map(([name, value]) => parseHtmlAttribute({
        name,
        value
      })));
    }

    if (type) return directives.filter(i => i.type === type);
    return sortDirectives(directives);
  }

  function sortDirectives(directives) {
    let directiveOrder = ['bind', 'model', 'show', 'catch-all'];
    return directives.sort((a, b) => {
      let typeA = directiveOrder.indexOf(a.type) === -1 ? 'catch-all' : a.type;
      let typeB = directiveOrder.indexOf(b.type) === -1 ? 'catch-all' : b.type;
      return directiveOrder.indexOf(typeA) - directiveOrder.indexOf(typeB);
    });
  }

  function parseHtmlAttribute({
    name,
    value
  }) {
    const normalizedName = replaceAtAndColonWithStandardSyntax(name);
    const typeMatch = normalizedName.match(xAttrRE);
    const valueMatch = normalizedName.match(/:([a-zA-Z0-9\-:]+)/);
    const modifiers = normalizedName.match(/\.[^.\]]+(?=[^\]]*$)/g) || [];
    return {
      type: typeMatch ? typeMatch[1] : null,
      value: valueMatch ? valueMatch[1] : null,
      modifiers: modifiers.map(i => i.replace('.', '')),
      expression: value
    };
  }
  function isBooleanAttr(attrName) {
    // As per HTML spec table https://html.spec.whatwg.org/multipage/indices.html#attributes-3:boolean-attribute
    // Array roughly ordered by estimated usage
    const booleanAttributes = ['disabled', 'checked', 'required', 'readonly', 'hidden', 'open', 'selected', 'autofocus', 'itemscope', 'multiple', 'novalidate', 'allowfullscreen', 'allowpaymentrequest', 'formnovalidate', 'autoplay', 'controls', 'loop', 'muted', 'playsinline', 'default', 'ismap', 'reversed', 'async', 'defer', 'nomodule'];
    return booleanAttributes.includes(attrName);
  }
  function replaceAtAndColonWithStandardSyntax(name) {
    if (name.startsWith('@')) {
      return name.replace('@', 'x-on:');
    } else if (name.startsWith(':')) {
      return name.replace(':', 'x-bind:');
    }

    return name;
  }
  function convertClassStringToArray(classList, filterFn = Boolean) {
    return classList.split(' ').filter(filterFn);
  }
  const TRANSITION_TYPE_IN = 'in';
  const TRANSITION_TYPE_OUT = 'out';
  const TRANSITION_CANCELLED = 'cancelled';
  function transitionIn(el, show, reject, component, forceSkip = false) {
    // We don't want to transition on the initial page load.
    if (forceSkip) return show();

    if (el.__x_transition && el.__x_transition.type === TRANSITION_TYPE_IN) {
      // there is already a similar transition going on, this was probably triggered by
      // a change in a different property, let's just leave the previous one doing its job
      return;
    }

    const attrs = getXAttrs(el, component, 'transition');
    const showAttr = getXAttrs(el, component, 'show')[0]; // If this is triggered by a x-show.transition.

    if (showAttr && showAttr.modifiers.includes('transition')) {
      let modifiers = showAttr.modifiers; // If x-show.transition.out, we'll skip the "in" transition.

      if (modifiers.includes('out') && !modifiers.includes('in')) return show();
      const settingBothSidesOfTransition = modifiers.includes('in') && modifiers.includes('out'); // If x-show.transition.in...out... only use "in" related modifiers for this transition.

      modifiers = settingBothSidesOfTransition ? modifiers.filter((i, index) => index < modifiers.indexOf('out')) : modifiers;
      transitionHelperIn(el, modifiers, show, reject); // Otherwise, we can assume x-transition:enter.
    } else if (attrs.some(attr => ['enter', 'enter-start', 'enter-end'].includes(attr.value))) {
      transitionClassesIn(el, component, attrs, show, reject);
    } else {
      // If neither, just show that damn thing.
      show();
    }
  }
  function transitionOut(el, hide, reject, component, forceSkip = false) {
    // We don't want to transition on the initial page load.
    if (forceSkip) return hide();

    if (el.__x_transition && el.__x_transition.type === TRANSITION_TYPE_OUT) {
      // there is already a similar transition going on, this was probably triggered by
      // a change in a different property, let's just leave the previous one doing its job
      return;
    }

    const attrs = getXAttrs(el, component, 'transition');
    const showAttr = getXAttrs(el, component, 'show')[0];

    if (showAttr && showAttr.modifiers.includes('transition')) {
      let modifiers = showAttr.modifiers;
      if (modifiers.includes('in') && !modifiers.includes('out')) return hide();
      const settingBothSidesOfTransition = modifiers.includes('in') && modifiers.includes('out');
      modifiers = settingBothSidesOfTransition ? modifiers.filter((i, index) => index > modifiers.indexOf('out')) : modifiers;
      transitionHelperOut(el, modifiers, settingBothSidesOfTransition, hide, reject);
    } else if (attrs.some(attr => ['leave', 'leave-start', 'leave-end'].includes(attr.value))) {
      transitionClassesOut(el, component, attrs, hide, reject);
    } else {
      hide();
    }
  }
  function transitionHelperIn(el, modifiers, showCallback, reject) {
    // Default values inspired by: https://material.io/design/motion/speed.html#duration
    const styleValues = {
      duration: modifierValue(modifiers, 'duration', 150),
      origin: modifierValue(modifiers, 'origin', 'center'),
      first: {
        opacity: 0,
        scale: modifierValue(modifiers, 'scale', 95)
      },
      second: {
        opacity: 1,
        scale: 100
      }
    };
    transitionHelper(el, modifiers, showCallback, () => {}, reject, styleValues, TRANSITION_TYPE_IN);
  }
  function transitionHelperOut(el, modifiers, settingBothSidesOfTransition, hideCallback, reject) {
    // Make the "out" transition .5x slower than the "in". (Visually better)
    // HOWEVER, if they explicitly set a duration for the "out" transition,
    // use that.
    const duration = settingBothSidesOfTransition ? modifierValue(modifiers, 'duration', 150) : modifierValue(modifiers, 'duration', 150) / 2;
    const styleValues = {
      duration: duration,
      origin: modifierValue(modifiers, 'origin', 'center'),
      first: {
        opacity: 1,
        scale: 100
      },
      second: {
        opacity: 0,
        scale: modifierValue(modifiers, 'scale', 95)
      }
    };
    transitionHelper(el, modifiers, () => {}, hideCallback, reject, styleValues, TRANSITION_TYPE_OUT);
  }

  function modifierValue(modifiers, key, fallback) {
    // If the modifier isn't present, use the default.
    if (modifiers.indexOf(key) === -1) return fallback; // If it IS present, grab the value after it: x-show.transition.duration.500ms

    const rawValue = modifiers[modifiers.indexOf(key) + 1];
    if (!rawValue) return fallback;

    if (key === 'scale') {
      // Check if the very next value is NOT a number and return the fallback.
      // If x-show.transition.scale, we'll use the default scale value.
      // That is how a user opts out of the opacity transition.
      if (!isNumeric(rawValue)) return fallback;
    }

    if (key === 'duration') {
      // Support x-show.transition.duration.500ms && duration.500
      let match = rawValue.match(/([0-9]+)ms/);
      if (match) return match[1];
    }

    if (key === 'origin') {
      // Support chaining origin directions: x-show.transition.top.right
      if (['top', 'right', 'left', 'center', 'bottom'].includes(modifiers[modifiers.indexOf(key) + 2])) {
        return [rawValue, modifiers[modifiers.indexOf(key) + 2]].join(' ');
      }
    }

    return rawValue;
  }

  function transitionHelper(el, modifiers, hook1, hook2, reject, styleValues, type) {
    // clear the previous transition if exists to avoid caching the wrong styles
    if (el.__x_transition) {
      el.__x_transition.cancel && el.__x_transition.cancel();
    } // If the user set these style values, we'll put them back when we're done with them.


    const opacityCache = el.style.opacity;
    const transformCache = el.style.transform;
    const transformOriginCache = el.style.transformOrigin; // If no modifiers are present: x-show.transition, we'll default to both opacity and scale.

    const noModifiers = !modifiers.includes('opacity') && !modifiers.includes('scale');
    const transitionOpacity = noModifiers || modifiers.includes('opacity');
    const transitionScale = noModifiers || modifiers.includes('scale'); // These are the explicit stages of a transition (same stages for in and for out).
    // This way you can get a birds eye view of the hooks, and the differences
    // between them.

    const stages = {
      start() {
        if (transitionOpacity) el.style.opacity = styleValues.first.opacity;
        if (transitionScale) el.style.transform = `scale(${styleValues.first.scale / 100})`;
      },

      during() {
        if (transitionScale) el.style.transformOrigin = styleValues.origin;
        el.style.transitionProperty = [transitionOpacity ? `opacity` : ``, transitionScale ? `transform` : ``].join(' ').trim();
        el.style.transitionDuration = `${styleValues.duration / 1000}s`;
        el.style.transitionTimingFunction = `cubic-bezier(0.4, 0.0, 0.2, 1)`;
      },

      show() {
        hook1();
      },

      end() {
        if (transitionOpacity) el.style.opacity = styleValues.second.opacity;
        if (transitionScale) el.style.transform = `scale(${styleValues.second.scale / 100})`;
      },

      hide() {
        hook2();
      },

      cleanup() {
        if (transitionOpacity) el.style.opacity = opacityCache;
        if (transitionScale) el.style.transform = transformCache;
        if (transitionScale) el.style.transformOrigin = transformOriginCache;
        el.style.transitionProperty = null;
        el.style.transitionDuration = null;
        el.style.transitionTimingFunction = null;
      }

    };
    transition(el, stages, type, reject);
  }

  const ensureStringExpression = (expression, el, component) => {
    return typeof expression === 'function' ? component.evaluateReturnExpression(el, expression) : expression;
  };

  function transitionClassesIn(el, component, directives, showCallback, reject) {
    const enter = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'enter') || {
      expression: ''
    }).expression, el, component));
    const enterStart = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'enter-start') || {
      expression: ''
    }).expression, el, component));
    const enterEnd = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'enter-end') || {
      expression: ''
    }).expression, el, component));
    transitionClasses(el, enter, enterStart, enterEnd, showCallback, () => {}, TRANSITION_TYPE_IN, reject);
  }
  function transitionClassesOut(el, component, directives, hideCallback, reject) {
    const leave = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'leave') || {
      expression: ''
    }).expression, el, component));
    const leaveStart = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'leave-start') || {
      expression: ''
    }).expression, el, component));
    const leaveEnd = convertClassStringToArray(ensureStringExpression((directives.find(i => i.value === 'leave-end') || {
      expression: ''
    }).expression, el, component));
    transitionClasses(el, leave, leaveStart, leaveEnd, () => {}, hideCallback, TRANSITION_TYPE_OUT, reject);
  }
  function transitionClasses(el, classesDuring, classesStart, classesEnd, hook1, hook2, type, reject) {
    // clear the previous transition if exists to avoid caching the wrong classes
    if (el.__x_transition) {
      el.__x_transition.cancel && el.__x_transition.cancel();
    }

    const originalClasses = el.__x_original_classes || [];
    const stages = {
      start() {
        el.classList.add(...classesStart);
      },

      during() {
        el.classList.add(...classesDuring);
      },

      show() {
        hook1();
      },

      end() {
        // Don't remove classes that were in the original class attribute.
        el.classList.remove(...classesStart.filter(i => !originalClasses.includes(i)));
        el.classList.add(...classesEnd);
      },

      hide() {
        hook2();
      },

      cleanup() {
        el.classList.remove(...classesDuring.filter(i => !originalClasses.includes(i)));
        el.classList.remove(...classesEnd.filter(i => !originalClasses.includes(i)));
      }

    };
    transition(el, stages, type, reject);
  }
  function transition(el, stages, type, reject) {
    const finish = once(() => {
      stages.hide(); // Adding an "isConnected" check, in case the callback
      // removed the element from the DOM.

      if (el.isConnected) {
        stages.cleanup();
      }

      delete el.__x_transition;
    });
    el.__x_transition = {
      // Set transition type so we can avoid clearing transition if the direction is the same
      type: type,
      // create a callback for the last stages of the transition so we can call it
      // from different point and early terminate it. Once will ensure that function
      // is only called one time.
      cancel: once(() => {
        reject(TRANSITION_CANCELLED);
        finish();
      }),
      finish,
      // This store the next animation frame so we can cancel it
      nextFrame: null
    };
    stages.start();
    stages.during();
    el.__x_transition.nextFrame = requestAnimationFrame(() => {
      // Note: Safari's transitionDuration property will list out comma separated transition durations
      // for every single transition property. Let's grab the first one and call it a day.
      let duration = Number(getComputedStyle(el).transitionDuration.replace(/,.*/, '').replace('s', '')) * 1000;

      if (duration === 0) {
        duration = Number(getComputedStyle(el).animationDuration.replace('s', '')) * 1000;
      }

      stages.show();
      el.__x_transition.nextFrame = requestAnimationFrame(() => {
        stages.end();
        setTimeout(el.__x_transition.finish, duration);
      });
    });
  }
  function isNumeric(subject) {
    return !Array.isArray(subject) && !isNaN(subject);
  } // Thanks @vuejs
  // https://github.com/vuejs/vue/blob/4de4649d9637262a9b007720b59f80ac72a5620c/src/shared/util.js

  function once(callback) {
    let called = false;
    return function () {
      if (!called) {
        called = true;
        callback.apply(this, arguments);
      }
    };
  }

  function handleForDirective(component, templateEl, expression, initialUpdate, extraVars) {
    warnIfMalformedTemplate(templateEl, 'x-for');
    let iteratorNames = typeof expression === 'function' ? parseForExpression(component.evaluateReturnExpression(templateEl, expression)) : parseForExpression(expression);
    let items = evaluateItemsAndReturnEmptyIfXIfIsPresentAndFalseOnElement(component, templateEl, iteratorNames, extraVars); // As we walk the array, we'll also walk the DOM (updating/creating as we go).

    let currentEl = templateEl;
    items.forEach((item, index) => {
      let iterationScopeVariables = getIterationScopeVariables(iteratorNames, item, index, items, extraVars());
      let currentKey = generateKeyForIteration(component, templateEl, index, iterationScopeVariables);
      let nextEl = lookAheadForMatchingKeyedElementAndMoveItIfFound(currentEl.nextElementSibling, currentKey); // If we haven't found a matching key, insert the element at the current position.

      if (!nextEl) {
        nextEl = addElementInLoopAfterCurrentEl(templateEl, currentEl); // And transition it in if it's not the first page load.

        transitionIn(nextEl, () => {}, () => {}, component, initialUpdate);
        nextEl.__x_for = iterationScopeVariables;
        component.initializeElements(nextEl, () => nextEl.__x_for); // Otherwise update the element we found.
      } else {
        // Temporarily remove the key indicator to allow the normal "updateElements" to work.
        delete nextEl.__x_for_key;
        nextEl.__x_for = iterationScopeVariables;
        component.updateElements(nextEl, () => nextEl.__x_for);
      }

      currentEl = nextEl;
      currentEl.__x_for_key = currentKey;
    });
    removeAnyLeftOverElementsFromPreviousUpdate(currentEl, component);
  } // This was taken from VueJS 2.* core. Thanks Vue!

  function parseForExpression(expression) {
    let forIteratorRE = /,([^,\}\]]*)(?:,([^,\}\]]*))?$/;
    let stripParensRE = /^\(|\)$/g;
    let forAliasRE = /([\s\S]*?)\s+(?:in|of)\s+([\s\S]*)/;
    let inMatch = String(expression).match(forAliasRE);
    if (!inMatch) return;
    let res = {};
    res.items = inMatch[2].trim();
    let item = inMatch[1].trim().replace(stripParensRE, '');
    let iteratorMatch = item.match(forIteratorRE);

    if (iteratorMatch) {
      res.item = item.replace(forIteratorRE, '').trim();
      res.index = iteratorMatch[1].trim();

      if (iteratorMatch[2]) {
        res.collection = iteratorMatch[2].trim();
      }
    } else {
      res.item = item;
    }

    return res;
  }

  function getIterationScopeVariables(iteratorNames, item, index, items, extraVars) {
    // We must create a new object, so each iteration has a new scope
    let scopeVariables = extraVars ? _objectSpread2({}, extraVars) : {};
    scopeVariables[iteratorNames.item] = item;
    if (iteratorNames.index) scopeVariables[iteratorNames.index] = index;
    if (iteratorNames.collection) scopeVariables[iteratorNames.collection] = items;
    return scopeVariables;
  }

  function generateKeyForIteration(component, el, index, iterationScopeVariables) {
    let bindKeyAttribute = getXAttrs(el, component, 'bind').filter(attr => attr.value === 'key')[0]; // If the dev hasn't specified a key, just return the index of the iteration.

    if (!bindKeyAttribute) return index;
    return component.evaluateReturnExpression(el, bindKeyAttribute.expression, () => iterationScopeVariables);
  }

  function evaluateItemsAndReturnEmptyIfXIfIsPresentAndFalseOnElement(component, el, iteratorNames, extraVars) {
    let ifAttribute = getXAttrs(el, component, 'if')[0];

    if (ifAttribute && !component.evaluateReturnExpression(el, ifAttribute.expression)) {
      return [];
    }

    let items = component.evaluateReturnExpression(el, iteratorNames.items, extraVars); // This adds support for the `i in n` syntax.

    if (isNumeric(items) && items >= 0) {
      items = Array.from(Array(items).keys(), i => i + 1);
    }

    return items;
  }

  function addElementInLoopAfterCurrentEl(templateEl, currentEl) {
    let clone = document.importNode(templateEl.content, true);
    currentEl.parentElement.insertBefore(clone, currentEl.nextElementSibling);
    return currentEl.nextElementSibling;
  }

  function lookAheadForMatchingKeyedElementAndMoveItIfFound(nextEl, currentKey) {
    if (!nextEl) return; // If we are already past the x-for generated elements, we don't need to look ahead.

    if (nextEl.__x_for_key === undefined) return; // If the the key's DO match, no need to look ahead.

    if (nextEl.__x_for_key === currentKey) return nextEl; // If they don't, we'll look ahead for a match.
    // If we find it, we'll move it to the current position in the loop.

    let tmpNextEl = nextEl;

    while (tmpNextEl) {
      if (tmpNextEl.__x_for_key === currentKey) {
        return tmpNextEl.parentElement.insertBefore(tmpNextEl, nextEl);
      }

      tmpNextEl = tmpNextEl.nextElementSibling && tmpNextEl.nextElementSibling.__x_for_key !== undefined ? tmpNextEl.nextElementSibling : false;
    }
  }

  function removeAnyLeftOverElementsFromPreviousUpdate(currentEl, component) {
    var nextElementFromOldLoop = currentEl.nextElementSibling && currentEl.nextElementSibling.__x_for_key !== undefined ? currentEl.nextElementSibling : false;

    while (nextElementFromOldLoop) {
      let nextElementFromOldLoopImmutable = nextElementFromOldLoop;
      let nextSibling = nextElementFromOldLoop.nextElementSibling;
      transitionOut(nextElementFromOldLoop, () => {
        nextElementFromOldLoopImmutable.remove();
      }, () => {}, component);
      nextElementFromOldLoop = nextSibling && nextSibling.__x_for_key !== undefined ? nextSibling : false;
    }
  }

  function handleAttributeBindingDirective(component, el, attrName, expression, extraVars, attrType, modifiers) {
    var value = component.evaluateReturnExpression(el, expression, extraVars);

    if (attrName === 'value') {
      if (Alpine.ignoreFocusedForValueBinding && document.activeElement.isSameNode(el)) return; // If nested model key is undefined, set the default value to empty string.

      if (value === undefined && String(expression).match(/\./)) {
        value = '';
      }

      if (el.type === 'radio') {
        // Set radio value from x-bind:value, if no "value" attribute exists.
        // If there are any initial state values, radio will have a correct
        // "checked" value since x-bind:value is processed before x-model.
        if (el.attributes.value === undefined && attrType === 'bind') {
          el.value = value;
        } else if (attrType !== 'bind') {
          el.checked = checkedAttrLooseCompare(el.value, value);
        }
      } else if (el.type === 'checkbox') {
        // If we are explicitly binding a string to the :value, set the string,
        // If the value is a boolean, leave it alone, it will be set to "on"
        // automatically.
        if (typeof value !== 'boolean' && ![null, undefined].includes(value) && attrType === 'bind') {
          el.value = String(value);
        } else if (attrType !== 'bind') {
          if (Array.isArray(value)) {
            // I'm purposely not using Array.includes here because it's
            // strict, and because of Numeric/String mis-casting, I
            // want the "includes" to be "fuzzy".
            el.checked = value.some(val => checkedAttrLooseCompare(val, el.value));
          } else {
            el.checked = !!value;
          }
        }
      } else if (el.tagName === 'SELECT') {
        updateSelect(el, value);
      } else {
        if (el.value === value) return;
        el.value = value;
      }
    } else if (attrName === 'class') {
      if (Array.isArray(value)) {
        const originalClasses = el.__x_original_classes || [];
        el.setAttribute('class', arrayUnique(originalClasses.concat(value)).join(' '));
      } else if (typeof value === 'object') {
        // Sorting the keys / class names by their boolean value will ensure that
        // anything that evaluates to `false` and needs to remove classes is run first.
        const keysSortedByBooleanValue = Object.keys(value).sort((a, b) => value[a] - value[b]);
        keysSortedByBooleanValue.forEach(classNames => {
          if (value[classNames]) {
            convertClassStringToArray(classNames).forEach(className => el.classList.add(className));
          } else {
            convertClassStringToArray(classNames).forEach(className => el.classList.remove(className));
          }
        });
      } else {
        const originalClasses = el.__x_original_classes || [];
        const newClasses = value ? convertClassStringToArray(value) : [];
        el.setAttribute('class', arrayUnique(originalClasses.concat(newClasses)).join(' '));
      }
    } else {
      attrName = modifiers.includes('camel') ? camelCase(attrName) : attrName; // If an attribute's bound value is null, undefined or false, remove the attribute

      if ([null, undefined, false].includes(value)) {
        el.removeAttribute(attrName);
      } else {
        isBooleanAttr(attrName) ? setIfChanged(el, attrName, attrName) : setIfChanged(el, attrName, value);
      }
    }
  }

  function setIfChanged(el, attrName, value) {
    if (el.getAttribute(attrName) != value) {
      el.setAttribute(attrName, value);
    }
  }

  function updateSelect(el, value) {
    const arrayWrappedValue = [].concat(value).map(value => {
      return value + '';
    });
    Array.from(el.options).forEach(option => {
      option.selected = arrayWrappedValue.includes(option.value || option.text);
    });
  }

  function handleTextDirective(el, output, expression) {
    // If nested model key is undefined, set the default value to empty string.
    if (output === undefined && String(expression).match(/\./)) {
      output = '';
    }

    el.textContent = output;
  }

  function handleHtmlDirective(component, el, expression, extraVars) {
    el.innerHTML = component.evaluateReturnExpression(el, expression, extraVars);
  }

  function handleShowDirective(component, el, value, modifiers, initialUpdate = false) {
    const hide = () => {
      el.style.display = 'none';
      el.__x_is_shown = false;
    };

    const show = () => {
      if (el.style.length === 1 && el.style.display === 'none') {
        el.removeAttribute('style');
      } else {
        el.style.removeProperty('display');
      }

      el.__x_is_shown = true;
    };

    if (initialUpdate === true) {
      if (value) {
        show();
      } else {
        hide();
      }

      return;
    }

    const handle = (resolve, reject) => {
      if (value) {
        if (el.style.display === 'none' || el.__x_transition) {
          transitionIn(el, () => {
            show();
          }, reject, component);
        }

        resolve(() => {});
      } else {
        if (el.style.display !== 'none') {
          transitionOut(el, () => {
            resolve(() => {
              hide();
            });
          }, reject, component);
        } else {
          resolve(() => {});
        }
      }
    }; // The working of x-show is a bit complex because we need to
    // wait for any child transitions to finish before hiding
    // some element. Also, this has to be done recursively.
    // If x-show.immediate, foregoe the waiting.


    if (modifiers.includes('immediate')) {
      handle(finish => finish(), () => {});
      return;
    } // x-show is encountered during a DOM tree walk. If an element
    // we encounter is NOT a child of another x-show element we
    // can execute the previous x-show stack (if one exists).


    if (component.showDirectiveLastElement && !component.showDirectiveLastElement.contains(el)) {
      component.executeAndClearRemainingShowDirectiveStack();
    }

    component.showDirectiveStack.push(handle);
    component.showDirectiveLastElement = el;
  }

  function handleIfDirective(component, el, expressionResult, initialUpdate, extraVars) {
    warnIfMalformedTemplate(el, 'x-if');
    const elementHasAlreadyBeenAdded = el.nextElementSibling && el.nextElementSibling.__x_inserted_me === true;

    if (expressionResult && (!elementHasAlreadyBeenAdded || el.__x_transition)) {
      const clone = document.importNode(el.content, true);
      el.parentElement.insertBefore(clone, el.nextElementSibling);
      transitionIn(el.nextElementSibling, () => {}, () => {}, component, initialUpdate);
      component.initializeElements(el.nextElementSibling, extraVars);
      el.nextElementSibling.__x_inserted_me = true;
    } else if (!expressionResult && elementHasAlreadyBeenAdded) {
      transitionOut(el.nextElementSibling, () => {
        el.nextElementSibling.remove();
      }, () => {}, component, initialUpdate);
    }
  }

  function registerListener(component, el, event, modifiers, expression, extraVars = {}) {
    const options = {
      passive: modifiers.includes('passive')
    };

    if (modifiers.includes('camel')) {
      event = camelCase(event);
    }

    let handler, listenerTarget;

    if (modifiers.includes('away')) {
      listenerTarget = document;

      handler = e => {
        // Don't do anything if the click came from the element or within it.
        if (el.contains(e.target)) return; // Don't do anything if this element isn't currently visible.

        if (el.offsetWidth < 1 && el.offsetHeight < 1) return; // Now that we are sure the element is visible, AND the click
        // is from outside it, let's run the expression.

        runListenerHandler(component, expression, e, extraVars);

        if (modifiers.includes('once')) {
          document.removeEventListener(event, handler, options);
        }
      };
    } else {
      listenerTarget = modifiers.includes('window') ? window : modifiers.includes('document') ? document : el;

      handler = e => {
        // Remove this global event handler if the element that declared it
        // has been removed. It's now stale.
        if (listenerTarget === window || listenerTarget === document) {
          if (!document.body.contains(el)) {
            listenerTarget.removeEventListener(event, handler, options);
            return;
          }
        }

        if (isKeyEvent(event)) {
          if (isListeningForASpecificKeyThatHasntBeenPressed(e, modifiers)) {
            return;
          }
        }

        if (modifiers.includes('prevent')) e.preventDefault();
        if (modifiers.includes('stop')) e.stopPropagation(); // If the .self modifier isn't present, or if it is present and
        // the target element matches the element we are registering the
        // event on, run the handler

        if (!modifiers.includes('self') || e.target === el) {
          const returnValue = runListenerHandler(component, expression, e, extraVars);
          returnValue.then(value => {
            if (value === false) {
              e.preventDefault();
            } else {
              if (modifiers.includes('once')) {
                listenerTarget.removeEventListener(event, handler, options);
              }
            }
          });
        }
      };
    }

    if (modifiers.includes('debounce')) {
      let nextModifier = modifiers[modifiers.indexOf('debounce') + 1] || 'invalid-wait';
      let wait = isNumeric(nextModifier.split('ms')[0]) ? Number(nextModifier.split('ms')[0]) : 250;
      handler = debounce(handler, wait);
    }

    listenerTarget.addEventListener(event, handler, options);
  }

  function runListenerHandler(component, expression, e, extraVars) {
    return component.evaluateCommandExpression(e.target, expression, () => {
      return _objectSpread2(_objectSpread2({}, extraVars()), {}, {
        '$event': e
      });
    });
  }

  function isKeyEvent(event) {
    return ['keydown', 'keyup'].includes(event);
  }

  function isListeningForASpecificKeyThatHasntBeenPressed(e, modifiers) {
    let keyModifiers = modifiers.filter(i => {
      return !['window', 'document', 'prevent', 'stop'].includes(i);
    });

    if (keyModifiers.includes('debounce')) {
      let debounceIndex = keyModifiers.indexOf('debounce');
      keyModifiers.splice(debounceIndex, isNumeric((keyModifiers[debounceIndex + 1] || 'invalid-wait').split('ms')[0]) ? 2 : 1);
    } // If no modifier is specified, we'll call it a press.


    if (keyModifiers.length === 0) return false; // If one is passed, AND it matches the key pressed, we'll call it a press.

    if (keyModifiers.length === 1 && keyModifiers[0] === keyToModifier(e.key)) return false; // The user is listening for key combinations.

    const systemKeyModifiers = ['ctrl', 'shift', 'alt', 'meta', 'cmd', 'super'];
    const selectedSystemKeyModifiers = systemKeyModifiers.filter(modifier => keyModifiers.includes(modifier));
    keyModifiers = keyModifiers.filter(i => !selectedSystemKeyModifiers.includes(i));

    if (selectedSystemKeyModifiers.length > 0) {
      const activelyPressedKeyModifiers = selectedSystemKeyModifiers.filter(modifier => {
        // Alias "cmd" and "super" to "meta"
        if (modifier === 'cmd' || modifier === 'super') modifier = 'meta';
        return e[`${modifier}Key`];
      }); // If all the modifiers selected are pressed, ...

      if (activelyPressedKeyModifiers.length === selectedSystemKeyModifiers.length) {
        // AND the remaining key is pressed as well. It's a press.
        if (keyModifiers[0] === keyToModifier(e.key)) return false;
      }
    } // We'll call it NOT a valid keypress.


    return true;
  }

  function keyToModifier(key) {
    switch (key) {
      case '/':
        return 'slash';

      case ' ':
      case 'Spacebar':
        return 'space';

      default:
        return key && kebabCase(key);
    }
  }

  function registerModelListener(component, el, modifiers, expression, extraVars) {
    // If the element we are binding to is a select, a radio, or checkbox
    // we'll listen for the change event instead of the "input" event.
    var event = el.tagName.toLowerCase() === 'select' || ['checkbox', 'radio'].includes(el.type) || modifiers.includes('lazy') ? 'change' : 'input';
    const listenerExpression = `${expression} = rightSideOfExpression($event, ${expression})`;
    registerListener(component, el, event, modifiers, listenerExpression, () => {
      return _objectSpread2(_objectSpread2({}, extraVars()), {}, {
        rightSideOfExpression: generateModelAssignmentFunction(el, modifiers, expression)
      });
    });
  }

  function generateModelAssignmentFunction(el, modifiers, expression) {
    if (el.type === 'radio') {
      // Radio buttons only work properly when they share a name attribute.
      // People might assume we take care of that for them, because
      // they already set a shared "x-model" attribute.
      if (!el.hasAttribute('name')) el.setAttribute('name', expression);
    }

    return (event, currentValue) => {
      // Check for event.detail due to an issue where IE11 handles other events as a CustomEvent.
      if (event instanceof CustomEvent && event.detail) {
        return event.detail;
      } else if (el.type === 'checkbox') {
        // If the data we are binding to is an array, toggle its value inside the array.
        if (Array.isArray(currentValue)) {
          const newValue = modifiers.includes('number') ? safeParseNumber(event.target.value) : event.target.value;
          return event.target.checked ? currentValue.concat([newValue]) : currentValue.filter(el => !checkedAttrLooseCompare(el, newValue));
        } else {
          return event.target.checked;
        }
      } else if (el.tagName.toLowerCase() === 'select' && el.multiple) {
        return modifiers.includes('number') ? Array.from(event.target.selectedOptions).map(option => {
          const rawValue = option.value || option.text;
          return safeParseNumber(rawValue);
        }) : Array.from(event.target.selectedOptions).map(option => {
          return option.value || option.text;
        });
      } else {
        const rawValue = event.target.value;
        return modifiers.includes('number') ? safeParseNumber(rawValue) : modifiers.includes('trim') ? rawValue.trim() : rawValue;
      }
    };
  }

  function safeParseNumber(rawValue) {
    const number = rawValue ? parseFloat(rawValue) : null;
    return isNumeric(number) ? number : rawValue;
  }

  /**
   * Copyright (C) 2017 salesforce.com, inc.
   */
  const { isArray } = Array;
  const { getPrototypeOf, create: ObjectCreate, defineProperty: ObjectDefineProperty, defineProperties: ObjectDefineProperties, isExtensible, getOwnPropertyDescriptor, getOwnPropertyNames, getOwnPropertySymbols, preventExtensions, hasOwnProperty, } = Object;
  const { push: ArrayPush, concat: ArrayConcat, map: ArrayMap, } = Array.prototype;
  function isUndefined(obj) {
      return obj === undefined;
  }
  function isFunction(obj) {
      return typeof obj === 'function';
  }
  function isObject(obj) {
      return typeof obj === 'object';
  }
  const proxyToValueMap = new WeakMap();
  function registerProxy(proxy, value) {
      proxyToValueMap.set(proxy, value);
  }
  const unwrap = (replicaOrAny) => proxyToValueMap.get(replicaOrAny) || replicaOrAny;

  function wrapValue(membrane, value) {
      return membrane.valueIsObservable(value) ? membrane.getProxy(value) : value;
  }
  /**
   * Unwrap property descriptors will set value on original descriptor
   * We only need to unwrap if value is specified
   * @param descriptor external descrpitor provided to define new property on original value
   */
  function unwrapDescriptor(descriptor) {
      if (hasOwnProperty.call(descriptor, 'value')) {
          descriptor.value = unwrap(descriptor.value);
      }
      return descriptor;
  }
  function lockShadowTarget(membrane, shadowTarget, originalTarget) {
      const targetKeys = ArrayConcat.call(getOwnPropertyNames(originalTarget), getOwnPropertySymbols(originalTarget));
      targetKeys.forEach((key) => {
          let descriptor = getOwnPropertyDescriptor(originalTarget, key);
          // We do not need to wrap the descriptor if configurable
          // Because we can deal with wrapping it when user goes through
          // Get own property descriptor. There is also a chance that this descriptor
          // could change sometime in the future, so we can defer wrapping
          // until we need to
          if (!descriptor.configurable) {
              descriptor = wrapDescriptor(membrane, descriptor, wrapValue);
          }
          ObjectDefineProperty(shadowTarget, key, descriptor);
      });
      preventExtensions(shadowTarget);
  }
  class ReactiveProxyHandler {
      constructor(membrane, value) {
          this.originalTarget = value;
          this.membrane = membrane;
      }
      get(shadowTarget, key) {
          const { originalTarget, membrane } = this;
          const value = originalTarget[key];
          const { valueObserved } = membrane;
          valueObserved(originalTarget, key);
          return membrane.getProxy(value);
      }
      set(shadowTarget, key, value) {
          const { originalTarget, membrane: { valueMutated } } = this;
          const oldValue = originalTarget[key];
          if (oldValue !== value) {
              originalTarget[key] = value;
              valueMutated(originalTarget, key);
          }
          else if (key === 'length' && isArray(originalTarget)) {
              // fix for issue #236: push will add the new index, and by the time length
              // is updated, the internal length is already equal to the new length value
              // therefore, the oldValue is equal to the value. This is the forking logic
              // to support this use case.
              valueMutated(originalTarget, key);
          }
          return true;
      }
      deleteProperty(shadowTarget, key) {
          const { originalTarget, membrane: { valueMutated } } = this;
          delete originalTarget[key];
          valueMutated(originalTarget, key);
          return true;
      }
      apply(shadowTarget, thisArg, argArray) {
          /* No op */
      }
      construct(target, argArray, newTarget) {
          /* No op */
      }
      has(shadowTarget, key) {
          const { originalTarget, membrane: { valueObserved } } = this;
          valueObserved(originalTarget, key);
          return key in originalTarget;
      }
      ownKeys(shadowTarget) {
          const { originalTarget } = this;
          return ArrayConcat.call(getOwnPropertyNames(originalTarget), getOwnPropertySymbols(originalTarget));
      }
      isExtensible(shadowTarget) {
          const shadowIsExtensible = isExtensible(shadowTarget);
          if (!shadowIsExtensible) {
              return shadowIsExtensible;
          }
          const { originalTarget, membrane } = this;
          const targetIsExtensible = isExtensible(originalTarget);
          if (!targetIsExtensible) {
              lockShadowTarget(membrane, shadowTarget, originalTarget);
          }
          return targetIsExtensible;
      }
      setPrototypeOf(shadowTarget, prototype) {
      }
      getPrototypeOf(shadowTarget) {
          const { originalTarget } = this;
          return getPrototypeOf(originalTarget);
      }
      getOwnPropertyDescriptor(shadowTarget, key) {
          const { originalTarget, membrane } = this;
          const { valueObserved } = this.membrane;
          // keys looked up via hasOwnProperty need to be reactive
          valueObserved(originalTarget, key);
          let desc = getOwnPropertyDescriptor(originalTarget, key);
          if (isUndefined(desc)) {
              return desc;
          }
          const shadowDescriptor = getOwnPropertyDescriptor(shadowTarget, key);
          if (!isUndefined(shadowDescriptor)) {
              return shadowDescriptor;
          }
          // Note: by accessing the descriptor, the key is marked as observed
          // but access to the value, setter or getter (if available) cannot observe
          // mutations, just like regular methods, in which case we just do nothing.
          desc = wrapDescriptor(membrane, desc, wrapValue);
          if (!desc.configurable) {
              // If descriptor from original target is not configurable,
              // We must copy the wrapped descriptor over to the shadow target.
              // Otherwise, proxy will throw an invariant error.
              // This is our last chance to lock the value.
              // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/handler/getOwnPropertyDescriptor#Invariants
              ObjectDefineProperty(shadowTarget, key, desc);
          }
          return desc;
      }
      preventExtensions(shadowTarget) {
          const { originalTarget, membrane } = this;
          lockShadowTarget(membrane, shadowTarget, originalTarget);
          preventExtensions(originalTarget);
          return true;
      }
      defineProperty(shadowTarget, key, descriptor) {
          const { originalTarget, membrane } = this;
          const { valueMutated } = membrane;
          const { configurable } = descriptor;
          // We have to check for value in descriptor
          // because Object.freeze(proxy) calls this method
          // with only { configurable: false, writeable: false }
          // Additionally, method will only be called with writeable:false
          // if the descriptor has a value, as opposed to getter/setter
          // So we can just check if writable is present and then see if
          // value is present. This eliminates getter and setter descriptors
          if (hasOwnProperty.call(descriptor, 'writable') && !hasOwnProperty.call(descriptor, 'value')) {
              const originalDescriptor = getOwnPropertyDescriptor(originalTarget, key);
              descriptor.value = originalDescriptor.value;
          }
          ObjectDefineProperty(originalTarget, key, unwrapDescriptor(descriptor));
          if (configurable === false) {
              ObjectDefineProperty(shadowTarget, key, wrapDescriptor(membrane, descriptor, wrapValue));
          }
          valueMutated(originalTarget, key);
          return true;
      }
  }

  function wrapReadOnlyValue(membrane, value) {
      return membrane.valueIsObservable(value) ? membrane.getReadOnlyProxy(value) : value;
  }
  class ReadOnlyHandler {
      constructor(membrane, value) {
          this.originalTarget = value;
          this.membrane = membrane;
      }
      get(shadowTarget, key) {
          const { membrane, originalTarget } = this;
          const value = originalTarget[key];
          const { valueObserved } = membrane;
          valueObserved(originalTarget, key);
          return membrane.getReadOnlyProxy(value);
      }
      set(shadowTarget, key, value) {
          return false;
      }
      deleteProperty(shadowTarget, key) {
          return false;
      }
      apply(shadowTarget, thisArg, argArray) {
          /* No op */
      }
      construct(target, argArray, newTarget) {
          /* No op */
      }
      has(shadowTarget, key) {
          const { originalTarget, membrane: { valueObserved } } = this;
          valueObserved(originalTarget, key);
          return key in originalTarget;
      }
      ownKeys(shadowTarget) {
          const { originalTarget } = this;
          return ArrayConcat.call(getOwnPropertyNames(originalTarget), getOwnPropertySymbols(originalTarget));
      }
      setPrototypeOf(shadowTarget, prototype) {
      }
      getOwnPropertyDescriptor(shadowTarget, key) {
          const { originalTarget, membrane } = this;
          const { valueObserved } = membrane;
          // keys looked up via hasOwnProperty need to be reactive
          valueObserved(originalTarget, key);
          let desc = getOwnPropertyDescriptor(originalTarget, key);
          if (isUndefined(desc)) {
              return desc;
          }
          const shadowDescriptor = getOwnPropertyDescriptor(shadowTarget, key);
          if (!isUndefined(shadowDescriptor)) {
              return shadowDescriptor;
          }
          // Note: by accessing the descriptor, the key is marked as observed
          // but access to the value or getter (if available) cannot be observed,
          // just like regular methods, in which case we just do nothing.
          desc = wrapDescriptor(membrane, desc, wrapReadOnlyValue);
          if (hasOwnProperty.call(desc, 'set')) {
              desc.set = undefined; // readOnly membrane does not allow setters
          }
          if (!desc.configurable) {
              // If descriptor from original target is not configurable,
              // We must copy the wrapped descriptor over to the shadow target.
              // Otherwise, proxy will throw an invariant error.
              // This is our last chance to lock the value.
              // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy/handler/getOwnPropertyDescriptor#Invariants
              ObjectDefineProperty(shadowTarget, key, desc);
          }
          return desc;
      }
      preventExtensions(shadowTarget) {
          return false;
      }
      defineProperty(shadowTarget, key, descriptor) {
          return false;
      }
  }
  function createShadowTarget(value) {
      let shadowTarget = undefined;
      if (isArray(value)) {
          shadowTarget = [];
      }
      else if (isObject(value)) {
          shadowTarget = {};
      }
      return shadowTarget;
  }
  const ObjectDotPrototype = Object.prototype;
  function defaultValueIsObservable(value) {
      // intentionally checking for null
      if (value === null) {
          return false;
      }
      // treat all non-object types, including undefined, as non-observable values
      if (typeof value !== 'object') {
          return false;
      }
      if (isArray(value)) {
          return true;
      }
      const proto = getPrototypeOf(value);
      return (proto === ObjectDotPrototype || proto === null || getPrototypeOf(proto) === null);
  }
  const defaultValueObserved = (obj, key) => {
      /* do nothing */
  };
  const defaultValueMutated = (obj, key) => {
      /* do nothing */
  };
  const defaultValueDistortion = (value) => value;
  function wrapDescriptor(membrane, descriptor, getValue) {
      const { set, get } = descriptor;
      if (hasOwnProperty.call(descriptor, 'value')) {
          descriptor.value = getValue(membrane, descriptor.value);
      }
      else {
          if (!isUndefined(get)) {
              descriptor.get = function () {
                  // invoking the original getter with the original target
                  return getValue(membrane, get.call(unwrap(this)));
              };
          }
          if (!isUndefined(set)) {
              descriptor.set = function (value) {
                  // At this point we don't have a clear indication of whether
                  // or not a valid mutation will occur, we don't have the key,
                  // and we are not sure why and how they are invoking this setter.
                  // Nevertheless we preserve the original semantics by invoking the
                  // original setter with the original target and the unwrapped value
                  set.call(unwrap(this), membrane.unwrapProxy(value));
              };
          }
      }
      return descriptor;
  }
  class ReactiveMembrane {
      constructor(options) {
          this.valueDistortion = defaultValueDistortion;
          this.valueMutated = defaultValueMutated;
          this.valueObserved = defaultValueObserved;
          this.valueIsObservable = defaultValueIsObservable;
          this.objectGraph = new WeakMap();
          if (!isUndefined(options)) {
              const { valueDistortion, valueMutated, valueObserved, valueIsObservable } = options;
              this.valueDistortion = isFunction(valueDistortion) ? valueDistortion : defaultValueDistortion;
              this.valueMutated = isFunction(valueMutated) ? valueMutated : defaultValueMutated;
              this.valueObserved = isFunction(valueObserved) ? valueObserved : defaultValueObserved;
              this.valueIsObservable = isFunction(valueIsObservable) ? valueIsObservable : defaultValueIsObservable;
          }
      }
      getProxy(value) {
          const unwrappedValue = unwrap(value);
          const distorted = this.valueDistortion(unwrappedValue);
          if (this.valueIsObservable(distorted)) {
              const o = this.getReactiveState(unwrappedValue, distorted);
              // when trying to extract the writable version of a readonly
              // we return the readonly.
              return o.readOnly === value ? value : o.reactive;
          }
          return distorted;
      }
      getReadOnlyProxy(value) {
          value = unwrap(value);
          const distorted = this.valueDistortion(value);
          if (this.valueIsObservable(distorted)) {
              return this.getReactiveState(value, distorted).readOnly;
          }
          return distorted;
      }
      unwrapProxy(p) {
          return unwrap(p);
      }
      getReactiveState(value, distortedValue) {
          const { objectGraph, } = this;
          let reactiveState = objectGraph.get(distortedValue);
          if (reactiveState) {
              return reactiveState;
          }
          const membrane = this;
          reactiveState = {
              get reactive() {
                  const reactiveHandler = new ReactiveProxyHandler(membrane, distortedValue);
                  // caching the reactive proxy after the first time it is accessed
                  const proxy = new Proxy(createShadowTarget(distortedValue), reactiveHandler);
                  registerProxy(proxy, value);
                  ObjectDefineProperty(this, 'reactive', { value: proxy });
                  return proxy;
              },
              get readOnly() {
                  const readOnlyHandler = new ReadOnlyHandler(membrane, distortedValue);
                  // caching the readOnly proxy after the first time it is accessed
                  const proxy = new Proxy(createShadowTarget(distortedValue), readOnlyHandler);
                  registerProxy(proxy, value);
                  ObjectDefineProperty(this, 'readOnly', { value: proxy });
                  return proxy;
              }
          };
          objectGraph.set(distortedValue, reactiveState);
          return reactiveState;
      }
  }
  /** version: 0.26.0 */

  function wrap(data, mutationCallback) {

    let membrane = new ReactiveMembrane({
      valueMutated(target, key) {
        mutationCallback(target, key);
      }

    });
    return {
      data: membrane.getProxy(data),
      membrane: membrane
    };
  }
  function unwrap$1(membrane, observable) {
    let unwrappedData = membrane.unwrapProxy(observable);
    let copy = {};
    Object.keys(unwrappedData).forEach(key => {
      if (['$el', '$refs', '$nextTick', '$watch'].includes(key)) return;
      copy[key] = unwrappedData[key];
    });
    return copy;
  }

  class Component {
    constructor(el, componentForClone = null) {
      this.$el = el;
      const dataAttr = this.$el.getAttribute('x-data');
      const dataExpression = dataAttr === '' ? '{}' : dataAttr;
      const initExpression = this.$el.getAttribute('x-init');
      let dataExtras = {
        $el: this.$el
      };
      let canonicalComponentElementReference = componentForClone ? componentForClone.$el : this.$el;
      Object.entries(Alpine.magicProperties).forEach(([name, callback]) => {
        Object.defineProperty(dataExtras, `$${name}`, {
          get: function get() {
            return callback(canonicalComponentElementReference);
          }
        });
      });
      this.unobservedData = componentForClone ? componentForClone.getUnobservedData() : saferEval(el, dataExpression, dataExtras);
      // Construct a Proxy-based observable. This will be used to handle reactivity.

      let {
        membrane,
        data
      } = this.wrapDataInObservable(this.unobservedData);
      this.$data = data;
      this.membrane = membrane; // After making user-supplied data methods reactive, we can now add
      // our magic properties to the original data for access.

      this.unobservedData.$el = this.$el;
      this.unobservedData.$refs = this.getRefsProxy();
      this.nextTickStack = [];

      this.unobservedData.$nextTick = callback => {
        this.nextTickStack.push(callback);
      };

      this.watchers = {};

      this.unobservedData.$watch = (property, callback) => {
        if (!this.watchers[property]) this.watchers[property] = [];
        this.watchers[property].push(callback);
      };
      /* MODERN-ONLY:START */
      // We remove this piece of code from the legacy build.
      // In IE11, we have already defined our helpers at this point.
      // Register custom magic properties.


      Object.entries(Alpine.magicProperties).forEach(([name, callback]) => {
        Object.defineProperty(this.unobservedData, `$${name}`, {
          get: function get() {
            return callback(canonicalComponentElementReference, this.$el);
          }
        });
      });
      /* MODERN-ONLY:END */

      this.showDirectiveStack = [];
      this.showDirectiveLastElement;
      componentForClone || Alpine.onBeforeComponentInitializeds.forEach(callback => callback(this));
      var initReturnedCallback; // If x-init is present AND we aren't cloning (skip x-init on clone)

      if (initExpression && !componentForClone) {
        // We want to allow data manipulation, but not trigger DOM updates just yet.
        // We haven't even initialized the elements with their Alpine bindings. I mean c'mon.
        this.pauseReactivity = true;
        initReturnedCallback = this.evaluateReturnExpression(this.$el, initExpression);
        this.pauseReactivity = false;
      } // Register all our listeners and set all our attribute bindings.
      // If we're cloning a component, the third parameter ensures no duplicate
      // event listeners are registered (the mutation observer will take care of them)


      this.initializeElements(this.$el, () => {}, componentForClone); // Use mutation observer to detect new elements being added within this component at run-time.
      // Alpine's just so darn flexible amirite?

      this.listenForNewElementsToInitialize();

      if (typeof initReturnedCallback === 'function') {
        // Run the callback returned from the "x-init" hook to allow the user to do stuff after
        // Alpine's got it's grubby little paws all over everything.
        initReturnedCallback.call(this.$data);
      }

      componentForClone || setTimeout(() => {
        Alpine.onComponentInitializeds.forEach(callback => callback(this));
      }, 0);
    }

    getUnobservedData() {
      return unwrap$1(this.membrane, this.$data);
    }

    wrapDataInObservable(data) {
      var self = this;
      let updateDom = debounce(function () {
        self.updateElements(self.$el);
      }, 0);
      return wrap(data, (target, key) => {
        if (self.watchers[key]) {
          // If there's a watcher for this specific key, run it.
          self.watchers[key].forEach(callback => callback(target[key]));
        } else if (Array.isArray(target)) {
          // Arrays are special cases, if any of the items change, we consider the array as mutated.
          Object.keys(self.watchers).forEach(fullDotNotationKey => {
            let dotNotationParts = fullDotNotationKey.split('.'); // Ignore length mutations since they would result in duplicate calls.
            // For example, when calling push, we would get a mutation for the item's key
            // and a second mutation for the length property.

            if (key === 'length') return;
            dotNotationParts.reduce((comparisonData, part) => {
              if (Object.is(target, comparisonData[part])) {
                self.watchers[fullDotNotationKey].forEach(callback => callback(target));
              }

              return comparisonData[part];
            }, self.unobservedData);
          });
        } else {
          // Let's walk through the watchers with "dot-notation" (foo.bar) and see
          // if this mutation fits any of them.
          Object.keys(self.watchers).filter(i => i.includes('.')).forEach(fullDotNotationKey => {
            let dotNotationParts = fullDotNotationKey.split('.'); // If this dot-notation watcher's last "part" doesn't match the current
            // key, then skip it early for performance reasons.

            if (key !== dotNotationParts[dotNotationParts.length - 1]) return; // Now, walk through the dot-notation "parts" recursively to find
            // a match, and call the watcher if one's found.

            dotNotationParts.reduce((comparisonData, part) => {
              if (Object.is(target, comparisonData)) {
                // Run the watchers.
                self.watchers[fullDotNotationKey].forEach(callback => callback(target[key]));
              }

              return comparisonData[part];
            }, self.unobservedData);
          });
        } // Don't react to data changes for cases like the `x-created` hook.


        if (self.pauseReactivity) return;
        updateDom();
      });
    }

    walkAndSkipNestedComponents(el, callback, initializeComponentCallback = () => {}) {
      walk(el, el => {
        // We've hit a component.
        if (el.hasAttribute('x-data')) {
          // If it's not the current one.
          if (!el.isSameNode(this.$el)) {
            // Initialize it if it's not.
            if (!el.__x) initializeComponentCallback(el); // Now we'll let that sub-component deal with itself.

            return false;
          }
        }

        return callback(el);
      });
    }

    initializeElements(rootEl, extraVars = () => {}, componentForClone = false) {
      this.walkAndSkipNestedComponents(rootEl, el => {
        // Don't touch spawns from for loop
        if (el.__x_for_key !== undefined) return false; // Don't touch spawns from if directives

        if (el.__x_inserted_me !== undefined) return false;
        this.initializeElement(el, extraVars, componentForClone ? false : true);
      }, el => {
        if (!componentForClone) el.__x = new Component(el);
      });
      this.executeAndClearRemainingShowDirectiveStack();
      this.executeAndClearNextTickStack(rootEl);
    }

    initializeElement(el, extraVars, shouldRegisterListeners = true) {
      // To support class attribute merging, we have to know what the element's
      // original class attribute looked like for reference.
      if (el.hasAttribute('class') && getXAttrs(el, this).length > 0) {
        el.__x_original_classes = convertClassStringToArray(el.getAttribute('class'));
      }

      shouldRegisterListeners && this.registerListeners(el, extraVars);
      this.resolveBoundAttributes(el, true, extraVars);
    }

    updateElements(rootEl, extraVars = () => {}) {
      this.walkAndSkipNestedComponents(rootEl, el => {
        // Don't touch spawns from for loop (and check if the root is actually a for loop in a parent, don't skip it.)
        if (el.__x_for_key !== undefined && !el.isSameNode(this.$el)) return false;
        this.updateElement(el, extraVars);
      }, el => {
        el.__x = new Component(el);
      });
      this.executeAndClearRemainingShowDirectiveStack();
      this.executeAndClearNextTickStack(rootEl);
    }

    executeAndClearNextTickStack(el) {
      // Skip spawns from alpine directives
      if (el === this.$el && this.nextTickStack.length > 0) {
        // We run the tick stack after the next frame to allow any
        // running transitions to pass the initial show stage.
        requestAnimationFrame(() => {
          while (this.nextTickStack.length > 0) {
            this.nextTickStack.shift()();
          }
        });
      }
    }

    executeAndClearRemainingShowDirectiveStack() {
      // The goal here is to start all the x-show transitions
      // and build a nested promise chain so that elements
      // only hide when the children are finished hiding.
      this.showDirectiveStack.reverse().map(handler => {
        return new Promise((resolve, reject) => {
          handler(resolve, reject);
        });
      }).reduce((promiseChain, promise) => {
        return promiseChain.then(() => {
          return promise.then(finishElement => {
            finishElement();
          });
        });
      }, Promise.resolve(() => {})).catch(e => {
        if (e !== TRANSITION_CANCELLED) throw e;
      }); // We've processed the handler stack. let's clear it.

      this.showDirectiveStack = [];
      this.showDirectiveLastElement = undefined;
    }

    updateElement(el, extraVars) {
      this.resolveBoundAttributes(el, false, extraVars);
    }

    registerListeners(el, extraVars) {
      getXAttrs(el, this).forEach(({
        type,
        value,
        modifiers,
        expression
      }) => {
        switch (type) {
          case 'on':
            registerListener(this, el, value, modifiers, expression, extraVars);
            break;

          case 'model':
            registerModelListener(this, el, modifiers, expression, extraVars);
            break;
        }
      });
    }

    resolveBoundAttributes(el, initialUpdate = false, extraVars) {
      let attrs = getXAttrs(el, this);
      attrs.forEach(({
        type,
        value,
        modifiers,
        expression
      }) => {
        switch (type) {
          case 'model':
            handleAttributeBindingDirective(this, el, 'value', expression, extraVars, type, modifiers);
            break;

          case 'bind':
            // The :key binding on an x-for is special, ignore it.
            if (el.tagName.toLowerCase() === 'template' && value === 'key') return;
            handleAttributeBindingDirective(this, el, value, expression, extraVars, type, modifiers);
            break;

          case 'text':
            var output = this.evaluateReturnExpression(el, expression, extraVars);
            handleTextDirective(el, output, expression);
            break;

          case 'html':
            handleHtmlDirective(this, el, expression, extraVars);
            break;

          case 'show':
            var output = this.evaluateReturnExpression(el, expression, extraVars);
            handleShowDirective(this, el, output, modifiers, initialUpdate);
            break;

          case 'if':
            // If this element also has x-for on it, don't process x-if.
            // We will let the "x-for" directive handle the "if"ing.
            if (attrs.some(i => i.type === 'for')) return;
            var output = this.evaluateReturnExpression(el, expression, extraVars);
            handleIfDirective(this, el, output, initialUpdate, extraVars);
            break;

          case 'for':
            handleForDirective(this, el, expression, initialUpdate, extraVars);
            break;

          case 'cloak':
            el.removeAttribute('x-cloak');
            break;
        }
      });
    }

    evaluateReturnExpression(el, expression, extraVars = () => {}) {
      return saferEval(el, expression, this.$data, _objectSpread2(_objectSpread2({}, extraVars()), {}, {
        $dispatch: this.getDispatchFunction(el)
      }));
    }

    evaluateCommandExpression(el, expression, extraVars = () => {}) {
      return saferEvalNoReturn(el, expression, this.$data, _objectSpread2(_objectSpread2({}, extraVars()), {}, {
        $dispatch: this.getDispatchFunction(el)
      }));
    }

    getDispatchFunction(el) {
      return (event, detail = {}) => {
        el.dispatchEvent(new CustomEvent(event, {
          detail,
          bubbles: true
        }));
      };
    }

    listenForNewElementsToInitialize() {
      const targetNode = this.$el;
      const observerOptions = {
        childList: true,
        attributes: true,
        subtree: true
      };
      const observer = new MutationObserver(mutations => {
        for (let i = 0; i < mutations.length; i++) {
          // Filter out mutations triggered from child components.
          const closestParentComponent = mutations[i].target.closest('[x-data]');
          if (!(closestParentComponent && closestParentComponent.isSameNode(this.$el))) continue;

          if (mutations[i].type === 'attributes' && mutations[i].attributeName === 'x-data') {
            const xAttr = mutations[i].target.getAttribute('x-data') || '{}';
            const rawData = saferEval(this.$el, xAttr, {
              $el: this.$el
            });
            Object.keys(rawData).forEach(key => {
              if (this.$data[key] !== rawData[key]) {
                this.$data[key] = rawData[key];
              }
            });
          }

          if (mutations[i].addedNodes.length > 0) {
            mutations[i].addedNodes.forEach(node => {
              if (node.nodeType !== 1 || node.__x_inserted_me) return;

              if (node.matches('[x-data]') && !node.__x) {
                node.__x = new Component(node);
                return;
              }

              this.initializeElements(node);
            });
          }
        }
      });
      observer.observe(targetNode, observerOptions);
    }

    getRefsProxy() {
      var self = this;
      var refObj = {};
      // One of the goals of this is to not hold elements in memory, but rather re-evaluate
      // the DOM when the system needs something from it. This way, the framework is flexible and
      // friendly to outside DOM changes from libraries like Vue/Livewire.
      // For this reason, I'm using an "on-demand" proxy to fake a "$refs" object.

      return new Proxy(refObj, {
        get(object, property) {
          if (property === '$isAlpineProxy') return true;
          var ref; // We can't just query the DOM because it's hard to filter out refs in
          // nested components.

          self.walkAndSkipNestedComponents(self.$el, el => {
            if (el.hasAttribute('x-ref') && el.getAttribute('x-ref') === property) {
              ref = el;
            }
          });
          return ref;
        }

      });
    }

  }

  const Alpine = {
    version: "2.8.2",
    pauseMutationObserver: false,
    magicProperties: {},
    onComponentInitializeds: [],
    onBeforeComponentInitializeds: [],
    ignoreFocusedForValueBinding: false,
    start: async function start() {
      if (!isTesting()) {
        await domReady();
      }

      this.discoverComponents(el => {
        this.initializeComponent(el);
      }); // It's easier and more performant to just support Turbolinks than listen
      // to MutationObserver mutations at the document level.

      document.addEventListener("turbolinks:load", () => {
        this.discoverUninitializedComponents(el => {
          this.initializeComponent(el);
        });
      });
      this.listenForNewUninitializedComponentsAtRunTime();
    },
    discoverComponents: function discoverComponents(callback) {
      const rootEls = document.querySelectorAll('[x-data]');
      rootEls.forEach(rootEl => {
        callback(rootEl);
      });
    },
    discoverUninitializedComponents: function discoverUninitializedComponents(callback, el = null) {
      const rootEls = (el || document).querySelectorAll('[x-data]');
      Array.from(rootEls).filter(el => el.__x === undefined).forEach(rootEl => {
        callback(rootEl);
      });
    },
    listenForNewUninitializedComponentsAtRunTime: function listenForNewUninitializedComponentsAtRunTime() {
      const targetNode = document.querySelector('body');
      const observerOptions = {
        childList: true,
        attributes: true,
        subtree: true
      };
      const observer = new MutationObserver(mutations => {
        if (this.pauseMutationObserver) return;

        for (let i = 0; i < mutations.length; i++) {
          if (mutations[i].addedNodes.length > 0) {
            mutations[i].addedNodes.forEach(node => {
              // Discard non-element nodes (like line-breaks)
              if (node.nodeType !== 1) return; // Discard any changes happening within an existing component.
              // They will take care of themselves.

              if (node.parentElement && node.parentElement.closest('[x-data]')) return;
              this.discoverUninitializedComponents(el => {
                this.initializeComponent(el);
              }, node.parentElement);
            });
          }
        }
      });
      observer.observe(targetNode, observerOptions);
    },
    initializeComponent: function initializeComponent(el) {
      if (!el.__x) {
        // Wrap in a try/catch so that we don't prevent other components
        // from initializing when one component contains an error.
        try {
          el.__x = new Component(el);
        } catch (error) {
          setTimeout(() => {
            throw error;
          }, 0);
        }
      }
    },
    clone: function clone(component, newEl) {
      if (!newEl.__x) {
        newEl.__x = new Component(newEl, component);
      }
    },
    addMagicProperty: function addMagicProperty(name, callback) {
      this.magicProperties[name] = callback;
    },
    onComponentInitialized: function onComponentInitialized(callback) {
      this.onComponentInitializeds.push(callback);
    },
    onBeforeComponentInitialized: function onBeforeComponentInitialized(callback) {
      this.onBeforeComponentInitializeds.push(callback);
    }
  };

  if (!isTesting()) {
    window.Alpine = Alpine;

    if (window.deferLoadingAlpine) {
      window.deferLoadingAlpine(function () {
        window.Alpine.start();
      });
    } else {
      window.Alpine.start();
    }
  }

  return Alpine;

})));


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __unused_webpack_exports, __webpack_require__) => {

__webpack_require__(/*! ./prism */ "./resources/js/prism.js");

__webpack_require__(/*! ./notify */ "./resources/js/notify.js");

/***/ }),

/***/ "./resources/js/notify.js":
/*!********************************!*\
  !*** ./resources/js/notify.js ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var alpinejs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! alpinejs */ "./node_modules/alpinejs/dist/alpine.js");
/* harmony import */ var alpinejs__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(alpinejs__WEBPACK_IMPORTED_MODULE_0__);

var notification = document.querySelector('div.notify');

if (notification) {
  setTimeout(function () {
    notification.remove();
  }, notify.timeout);
}

/***/ }),

/***/ "./resources/js/prism.js":
/*!*******************************!*\
  !*** ./resources/js/prism.js ***!
  \*******************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

/* PrismJS 1.17.1
https://prismjs.com/download.html#themes=prism-twilight&languages=markup+css+clike+css-extras+diff+markup-templating+php+php-extras&plugins=line-highlight+autolinker+data-uri-highlight+custom-class+file-highlight+toolbar+highlight-keywords+inline-color+autoloader+command-line+normalize-whitespace+show-invisibles+show-language+match-braces */
var _self = "undefined" != typeof window ? window : "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? self : {},
    Prism = function (u) {
  var c = /\blang(?:uage)?-([\w-]+)\b/i,
      r = 0;
  var _ = {
    manual: u.Prism && u.Prism.manual,
    disableWorkerMessageHandler: u.Prism && u.Prism.disableWorkerMessageHandler,
    util: {
      encode: function encode(e) {
        return e instanceof L ? new L(e.type, _.util.encode(e.content), e.alias) : Array.isArray(e) ? e.map(_.util.encode) : e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/\u00a0/g, " ");
      },
      type: function type(e) {
        return Object.prototype.toString.call(e).slice(8, -1);
      },
      objId: function objId(e) {
        return e.__id || Object.defineProperty(e, "__id", {
          value: ++r
        }), e.__id;
      },
      clone: function n(e, t) {
        var a,
            r,
            i = _.util.type(e);

        switch (t = t || {}, i) {
          case "Object":
            if (r = _.util.objId(e), t[r]) return t[r];

            for (var o in a = {}, t[r] = a, e) {
              e.hasOwnProperty(o) && (a[o] = n(e[o], t));
            }

            return a;

          case "Array":
            return r = _.util.objId(e), t[r] ? t[r] : (a = [], t[r] = a, e.forEach(function (e, r) {
              a[r] = n(e, t);
            }), a);

          default:
            return e;
        }
      },
      currentScript: function currentScript() {
        if ("undefined" == typeof document) return null;
        if ("currentScript" in document) return document.currentScript;

        try {
          throw new Error();
        } catch (e) {
          var r = (/at [^(\r\n]*\((.*):.+:.+\)$/i.exec(e.stack) || [])[1];

          if (r) {
            var n = document.getElementsByTagName("script");

            for (var t in n) {
              if (n[t].src == r) return n[t];
            }
          }

          return null;
        }
      }
    },
    languages: {
      extend: function extend(e, r) {
        var n = _.util.clone(_.languages[e]);

        for (var t in r) {
          n[t] = r[t];
        }

        return n;
      },
      insertBefore: function insertBefore(n, e, r, t) {
        var a = (t = t || _.languages)[n],
            i = {};

        for (var o in a) {
          if (a.hasOwnProperty(o)) {
            if (o == e) for (var l in r) {
              r.hasOwnProperty(l) && (i[l] = r[l]);
            }
            r.hasOwnProperty(o) || (i[o] = a[o]);
          }
        }

        var s = t[n];
        return t[n] = i, _.languages.DFS(_.languages, function (e, r) {
          r === s && e != n && (this[e] = i);
        }), i;
      },
      DFS: function e(r, n, t, a) {
        a = a || {};
        var i = _.util.objId;

        for (var o in r) {
          if (r.hasOwnProperty(o)) {
            n.call(r, o, r[o], t || o);

            var l = r[o],
                s = _.util.type(l);

            "Object" !== s || a[i(l)] ? "Array" !== s || a[i(l)] || (a[i(l)] = !0, e(l, n, o, a)) : (a[i(l)] = !0, e(l, n, null, a));
          }
        }
      }
    },
    plugins: {},
    highlightAll: function highlightAll(e, r) {
      _.highlightAllUnder(document, e, r);
    },
    highlightAllUnder: function highlightAllUnder(e, r, n) {
      var t = {
        callback: n,
        selector: 'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'
      };

      _.hooks.run("before-highlightall", t);

      for (var a, i = e.querySelectorAll(t.selector), o = 0; a = i[o++];) {
        _.highlightElement(a, !0 === r, t.callback);
      }
    },
    highlightElement: function highlightElement(e, r, n) {
      var t = function (e) {
        for (; e && !c.test(e.className);) {
          e = e.parentNode;
        }

        return e ? (e.className.match(c) || [, "none"])[1].toLowerCase() : "none";
      }(e),
          a = _.languages[t];

      e.className = e.className.replace(c, "").replace(/\s+/g, " ") + " language-" + t;
      var i = e.parentNode;
      i && "pre" === i.nodeName.toLowerCase() && (i.className = i.className.replace(c, "").replace(/\s+/g, " ") + " language-" + t);
      var o = {
        element: e,
        language: t,
        grammar: a,
        code: e.textContent
      };

      function l(e) {
        o.highlightedCode = e, _.hooks.run("before-insert", o), o.element.innerHTML = o.highlightedCode, _.hooks.run("after-highlight", o), _.hooks.run("complete", o), n && n.call(o.element);
      }

      if (_.hooks.run("before-sanity-check", o), !o.code) return _.hooks.run("complete", o), void (n && n.call(o.element));
      if (_.hooks.run("before-highlight", o), o.grammar) {
        if (r && u.Worker) {
          var s = new Worker(_.filename);
          s.onmessage = function (e) {
            l(e.data);
          }, s.postMessage(JSON.stringify({
            language: o.language,
            code: o.code,
            immediateClose: !0
          }));
        } else l(_.highlight(o.code, o.grammar, o.language));
      } else l(_.util.encode(o.code));
    },
    highlight: function highlight(e, r, n) {
      var t = {
        code: e,
        grammar: r,
        language: n
      };
      return _.hooks.run("before-tokenize", t), t.tokens = _.tokenize(t.code, t.grammar), _.hooks.run("after-tokenize", t), L.stringify(_.util.encode(t.tokens), t.language);
    },
    matchGrammar: function matchGrammar(e, r, n, t, a, i, o) {
      for (var l in n) {
        if (n.hasOwnProperty(l) && n[l]) {
          var s = n[l];
          s = Array.isArray(s) ? s : [s];

          for (var u = 0; u < s.length; ++u) {
            if (o && o == l + "," + u) return;
            var c = s[u],
                g = c.inside,
                f = !!c.lookbehind,
                d = !!c.greedy,
                h = 0,
                m = c.alias;

            if (d && !c.pattern.global) {
              var p = c.pattern.toString().match(/[imsuy]*$/)[0];
              c.pattern = RegExp(c.pattern.source, p + "g");
            }

            c = c.pattern || c;

            for (var y = t, v = a; y < r.length; v += r[y].length, ++y) {
              var k = r[y];
              if (r.length > e.length) return;

              if (!(k instanceof L)) {
                if (d && y != r.length - 1) {
                  if (c.lastIndex = v, !(O = c.exec(e))) break;

                  for (var b = O.index + (f && O[1] ? O[1].length : 0), w = O.index + O[0].length, A = y, P = v, x = r.length; A < x && (P < w || !r[A].type && !r[A - 1].greedy); ++A) {
                    (P += r[A].length) <= b && (++y, v = P);
                  }

                  if (r[y] instanceof L) continue;
                  S = A - y, k = e.slice(v, P), O.index -= v;
                } else {
                  c.lastIndex = 0;
                  var O = c.exec(k),
                      S = 1;
                }

                if (O) {
                  f && (h = O[1] ? O[1].length : 0);
                  w = (b = O.index + h) + (O = O[0].slice(h)).length;
                  var j = k.slice(0, b),
                      N = k.slice(w),
                      E = [y, S];
                  j && (++y, v += j.length, E.push(j));
                  var C = new L(l, g ? _.tokenize(O, g) : O, m, O, d);
                  if (E.push(C), N && E.push(N), Array.prototype.splice.apply(r, E), 1 != S && _.matchGrammar(e, r, n, y, v, !0, l + "," + u), i) break;
                } else if (i) break;
              }
            }
          }
        }
      }
    },
    tokenize: function tokenize(e, r) {
      var n = [e],
          t = r.rest;

      if (t) {
        for (var a in t) {
          r[a] = t[a];
        }

        delete r.rest;
      }

      return _.matchGrammar(e, n, r, 0, 0, !1), n;
    },
    hooks: {
      all: {},
      add: function add(e, r) {
        var n = _.hooks.all;
        n[e] = n[e] || [], n[e].push(r);
      },
      run: function run(e, r) {
        var n = _.hooks.all[e];
        if (n && n.length) for (var t, a = 0; t = n[a++];) {
          t(r);
        }
      }
    },
    Token: L
  };

  function L(e, r, n, t, a) {
    this.type = e, this.content = r, this.alias = n, this.length = 0 | (t || "").length, this.greedy = !!a;
  }

  if (u.Prism = _, L.stringify = function (e, r) {
    if ("string" == typeof e) return e;
    if (Array.isArray(e)) return e.map(function (e) {
      return L.stringify(e, r);
    }).join("");
    var n = {
      type: e.type,
      content: L.stringify(e.content, r),
      tag: "span",
      classes: ["token", e.type],
      attributes: {},
      language: r
    };

    if (e.alias) {
      var t = Array.isArray(e.alias) ? e.alias : [e.alias];
      Array.prototype.push.apply(n.classes, t);
    }

    _.hooks.run("wrap", n);

    var a = Object.keys(n.attributes).map(function (e) {
      return e + '="' + (n.attributes[e] || "").replace(/"/g, "&quot;") + '"';
    }).join(" ");
    return "<" + n.tag + ' class="' + n.classes.join(" ") + '"' + (a ? " " + a : "") + ">" + n.content + "</" + n.tag + ">";
  }, !u.document) return u.addEventListener && (_.disableWorkerMessageHandler || u.addEventListener("message", function (e) {
    var r = JSON.parse(e.data),
        n = r.language,
        t = r.code,
        a = r.immediateClose;
    u.postMessage(_.highlight(t, _.languages[n], n)), a && u.close();
  }, !1)), _;

  var e = _.util.currentScript();

  if (e && (_.filename = e.src, e.hasAttribute("data-manual") && (_.manual = !0)), !_.manual) {
    var n = function n() {
      _.manual || _.highlightAll();
    };

    var t = document.readyState;
    "loading" === t || "interactive" === t && e.defer ? document.addEventListener("DOMContentLoaded", n) : window.requestAnimationFrame ? window.requestAnimationFrame(n) : window.setTimeout(n, 16);
  }

  return _;
}(_self);

 true && module.exports && (module.exports = Prism), "undefined" != typeof __webpack_require__.g && (__webpack_require__.g.Prism = Prism);
Prism.languages.markup = {
  comment: /<!--[\s\S]*?-->/,
  prolog: /<\?[\s\S]+?\?>/,
  doctype: {
    pattern: /<!DOCTYPE(?:[^>"'[\]]|"[^"]*"|'[^']*')+(?:\[(?:(?!<!--)[^"'\]]|"[^"]*"|'[^']*'|<!--[\s\S]*?-->)*\]\s*)?>/i,
    greedy: !0
  },
  cdata: /<!\[CDATA\[[\s\S]*?]]>/i,
  tag: {
    pattern: /<\/?(?!\d)[^\s>\/=$<%]+(?:\s(?:\s*[^\s>\/=]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+(?=[\s>]))|(?=[\s/>])))+)?\s*\/?>/i,
    greedy: !0,
    inside: {
      tag: {
        pattern: /^<\/?[^\s>\/]+/i,
        inside: {
          punctuation: /^<\/?/,
          namespace: /^[^\s>\/:]+:/
        }
      },
      "attr-value": {
        pattern: /=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+)/i,
        inside: {
          punctuation: [/^=/, {
            pattern: /^(\s*)["']|["']$/,
            lookbehind: !0
          }]
        }
      },
      punctuation: /\/?>/,
      "attr-name": {
        pattern: /[^\s>\/]+/,
        inside: {
          namespace: /^[^\s>\/:]+:/
        }
      }
    }
  },
  entity: /&#?[\da-z]{1,8};/i
}, Prism.languages.markup.tag.inside["attr-value"].inside.entity = Prism.languages.markup.entity, Prism.hooks.add("wrap", function (a) {
  "entity" === a.type && (a.attributes.title = a.content.replace(/&amp;/, "&"));
}), Object.defineProperty(Prism.languages.markup.tag, "addInlined", {
  value: function value(a, e) {
    var s = {};
    s["language-" + e] = {
      pattern: /(^<!\[CDATA\[)[\s\S]+?(?=\]\]>$)/i,
      lookbehind: !0,
      inside: Prism.languages[e]
    }, s.cdata = /^<!\[CDATA\[|\]\]>$/i;
    var n = {
      "included-cdata": {
        pattern: /<!\[CDATA\[[\s\S]*?\]\]>/i,
        inside: s
      }
    };
    n["language-" + e] = {
      pattern: /[\s\S]+/,
      inside: Prism.languages[e]
    };
    var t = {};
    t[a] = {
      pattern: RegExp("(<__[\\s\\S]*?>)(?:<!\\[CDATA\\[[\\s\\S]*?\\]\\]>\\s*|[\\s\\S])*?(?=<\\/__>)".replace(/__/g, a), "i"),
      lookbehind: !0,
      greedy: !0,
      inside: n
    }, Prism.languages.insertBefore("markup", "cdata", t);
  }
}), Prism.languages.xml = Prism.languages.extend("markup", {}), Prism.languages.html = Prism.languages.markup, Prism.languages.mathml = Prism.languages.markup, Prism.languages.svg = Prism.languages.markup;
!function (s) {
  var t = /("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/;
  s.languages.css = {
    comment: /\/\*[\s\S]*?\*\//,
    atrule: {
      pattern: /@[\w-]+[\s\S]*?(?:;|(?=\s*\{))/,
      inside: {
        rule: /@[\w-]+/
      }
    },
    url: {
      pattern: RegExp("url\\((?:" + t.source + "|[^\n\r()]*)\\)", "i"),
      inside: {
        "function": /^url/i,
        punctuation: /^\(|\)$/
      }
    },
    selector: RegExp("[^{}\\s](?:[^{};\"']|" + t.source + ")*?(?=\\s*\\{)"),
    string: {
      pattern: t,
      greedy: !0
    },
    property: /[-_a-z\xA0-\uFFFF][-\w\xA0-\uFFFF]*(?=\s*:)/i,
    important: /!important\b/i,
    "function": /[-a-z0-9]+(?=\()/i,
    punctuation: /[(){};:,]/
  }, s.languages.css.atrule.inside.rest = s.languages.css;
  var e = s.languages.markup;
  e && (e.tag.addInlined("style", "css"), s.languages.insertBefore("inside", "attr-value", {
    "style-attr": {
      pattern: /\s*style=("|')(?:\\[\s\S]|(?!\1)[^\\])*\1/i,
      inside: {
        "attr-name": {
          pattern: /^\s*style/i,
          inside: e.tag.inside
        },
        punctuation: /^\s*=\s*['"]|['"]\s*$/,
        "attr-value": {
          pattern: /.+/i,
          inside: s.languages.css
        }
      },
      alias: "language-css"
    }
  }, e.tag));
}(Prism);
Prism.languages.clike = {
  comment: [{
    pattern: /(^|[^\\])\/\*[\s\S]*?(?:\*\/|$)/,
    lookbehind: !0
  }, {
    pattern: /(^|[^\\:])\/\/.*/,
    lookbehind: !0,
    greedy: !0
  }],
  string: {
    pattern: /(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,
    greedy: !0
  },
  "class-name": {
    pattern: /(\b(?:class|interface|extends|implements|trait|instanceof|new)\s+|\bcatch\s+\()[\w.\\]+/i,
    lookbehind: !0,
    inside: {
      punctuation: /[.\\]/
    }
  },
  keyword: /\b(?:if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,
  "boolean": /\b(?:true|false)\b/,
  "function": /\w+(?=\()/,
  number: /\b0x[\da-f]+\b|(?:\b\d+\.?\d*|\B\.\d+)(?:e[+-]?\d+)?/i,
  operator: /[<>]=?|[!=]=?=?|--?|\+\+?|&&?|\|\|?|[?*/~^%]/,
  punctuation: /[{}[\];(),.:]/
};
!function (e) {
  e.languages.css.selector = {
    pattern: e.languages.css.selector,
    inside: {
      "pseudo-element": /:(?:after|before|first-letter|first-line|selection)|::[-\w]+/,
      "pseudo-class": /:[-\w]+/,
      "class": /\.[-:.\w]+/,
      id: /#[-:.\w]+/,
      attribute: {
        pattern: /\[(?:[^[\]"']|("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1)*\]/,
        greedy: !0,
        inside: {
          punctuation: /^\[|\]$/,
          "case-sensitivity": {
            pattern: /(\s)[si]$/i,
            lookbehind: !0,
            alias: "keyword"
          },
          namespace: {
            pattern: /^(\s*)[-*\w\xA0-\uFFFF]*\|(?!=)/,
            lookbehind: !0,
            inside: {
              punctuation: /\|$/
            }
          },
          attribute: {
            pattern: /^(\s*)[-\w\xA0-\uFFFF]+/,
            lookbehind: !0
          },
          value: [/("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/, {
            pattern: /(=\s*)[-\w\xA0-\uFFFF]+(?=\s*$)/,
            lookbehind: !0
          }],
          operator: /[|~*^$]?=/
        }
      },
      "n-th": [{
        pattern: /(\(\s*)[+-]?\d*[\dn](?:\s*[+-]\s*\d+)?(?=\s*\))/,
        lookbehind: !0,
        inside: {
          number: /[\dn]+/,
          operator: /[+-]/
        }
      }, {
        pattern: /(\(\s*)(?:even|odd)(?=\s*\))/i,
        lookbehind: !0
      }],
      punctuation: /[()]/
    }
  }, e.languages.insertBefore("css", "property", {
    variable: {
      pattern: /(^|[^-\w\xA0-\uFFFF])--[-_a-z\xA0-\uFFFF][-\w\xA0-\uFFFF]*/i,
      lookbehind: !0
    }
  });
  var a = {
    pattern: /(\d)(?:%|[a-z]+)/,
    lookbehind: !0
  },
      n = {
    pattern: /(^|[^\w.-])-?\d*\.?\d+/,
    lookbehind: !0
  };
  e.languages.insertBefore("css", "function", {
    operator: {
      pattern: /(\s)[+\-*\/](?=\s)/,
      lookbehind: !0
    },
    hexcode: {
      pattern: /\B#(?:[\da-f]{1,2}){3,4}\b/i,
      alias: "color"
    },
    color: [/\b(?:AliceBlue|AntiqueWhite|Aqua|Aquamarine|Azure|Beige|Bisque|Black|BlanchedAlmond|Blue|BlueViolet|Brown|BurlyWood|CadetBlue|Chartreuse|Chocolate|Coral|CornflowerBlue|Cornsilk|Crimson|Cyan|DarkBlue|DarkCyan|DarkGoldenRod|DarkGr[ae]y|DarkGreen|DarkKhaki|DarkMagenta|DarkOliveGreen|DarkOrange|DarkOrchid|DarkRed|DarkSalmon|DarkSeaGreen|DarkSlateBlue|DarkSlateGr[ae]y|DarkTurquoise|DarkViolet|DeepPink|DeepSkyBlue|DimGr[ae]y|DodgerBlue|FireBrick|FloralWhite|ForestGreen|Fuchsia|Gainsboro|GhostWhite|Gold|GoldenRod|Gr[ae]y|Green|GreenYellow|HoneyDew|HotPink|IndianRed|Indigo|Ivory|Khaki|Lavender|LavenderBlush|LawnGreen|LemonChiffon|LightBlue|LightCoral|LightCyan|LightGoldenRodYellow|LightGr[ae]y|LightGreen|LightPink|LightSalmon|LightSeaGreen|LightSkyBlue|LightSlateGr[ae]y|LightSteelBlue|LightYellow|Lime|LimeGreen|Linen|Magenta|Maroon|MediumAquaMarine|MediumBlue|MediumOrchid|MediumPurple|MediumSeaGreen|MediumSlateBlue|MediumSpringGreen|MediumTurquoise|MediumVioletRed|MidnightBlue|MintCream|MistyRose|Moccasin|NavajoWhite|Navy|OldLace|Olive|OliveDrab|Orange|OrangeRed|Orchid|PaleGoldenRod|PaleGreen|PaleTurquoise|PaleVioletRed|PapayaWhip|PeachPuff|Peru|Pink|Plum|PowderBlue|Purple|Red|RosyBrown|RoyalBlue|SaddleBrown|Salmon|SandyBrown|SeaGreen|SeaShell|Sienna|Silver|SkyBlue|SlateBlue|SlateGr[ae]y|Snow|SpringGreen|SteelBlue|Tan|Teal|Thistle|Tomato|Turquoise|Violet|Wheat|White|WhiteSmoke|Yellow|YellowGreen)\b/i, {
      pattern: /\b(?:rgb|hsl)\(\s*\d{1,3}\s*,\s*\d{1,3}%?\s*,\s*\d{1,3}%?\s*\)\B|\b(?:rgb|hsl)a\(\s*\d{1,3}\s*,\s*\d{1,3}%?\s*,\s*\d{1,3}%?\s*,\s*(?:0|0?\.\d+|1)\s*\)\B/i,
      inside: {
        unit: a,
        number: n,
        "function": /[\w-]+(?=\()/,
        punctuation: /[(),]/
      }
    }],
    entity: /\\[\da-f]{1,8}/i,
    unit: a,
    number: n
  });
}(Prism);
!function (d) {
  d.languages.diff = {
    coord: [/^(?:\*{3}|-{3}|\+{3}).*$/m, /^@@.*@@$/m, /^\d+.*$/m]
  };
  var r = {
    "deleted-sign": "-",
    "deleted-arrow": "<",
    "inserted-sign": "+",
    "inserted-arrow": ">",
    unchanged: " ",
    diff: "!"
  };
  Object.keys(r).forEach(function (e) {
    var n = r[e],
        a = [];
    /^\w+$/.test(e) || a.push(/\w+/.exec(e)[0]), "diff" === e && a.push("bold"), d.languages.diff[e] = {
      pattern: RegExp("^(?:[" + n + "].*(?:\r\n?|\n|(?![\\s\\S])))+", "m"),
      alias: a
    };
  }), Object.defineProperty(d.languages.diff, "PREFIXES", {
    value: r
  });
}(Prism);
!function (h) {
  function v(e, n) {
    return "___" + e.toUpperCase() + n + "___";
  }

  Object.defineProperties(h.languages["markup-templating"] = {}, {
    buildPlaceholders: {
      value: function value(a, r, e, o) {
        if (a.language === r) {
          var c = a.tokenStack = [];
          a.code = a.code.replace(e, function (e) {
            if ("function" == typeof o && !o(e)) return e;

            for (var n, t = c.length; -1 !== a.code.indexOf(n = v(r, t));) {
              ++t;
            }

            return c[t] = e, n;
          }), a.grammar = h.languages.markup;
        }
      }
    },
    tokenizePlaceholders: {
      value: function value(p, k) {
        if (p.language === k && p.tokenStack) {
          p.grammar = h.languages[k];
          var m = 0,
              d = Object.keys(p.tokenStack);
          !function e(n) {
            for (var t = 0; t < n.length && !(m >= d.length); t++) {
              var a = n[t];

              if ("string" == typeof a || a.content && "string" == typeof a.content) {
                var r = d[m],
                    o = p.tokenStack[r],
                    c = "string" == typeof a ? a : a.content,
                    i = v(k, r),
                    u = c.indexOf(i);

                if (-1 < u) {
                  ++m;
                  var g = c.substring(0, u),
                      l = new h.Token(k, h.tokenize(o, p.grammar), "language-" + k, o),
                      s = c.substring(u + i.length),
                      f = [];
                  g && f.push.apply(f, e([g])), f.push(l), s && f.push.apply(f, e([s])), "string" == typeof a ? n.splice.apply(n, [t, 1].concat(f)) : a.content = f;
                }
              } else a.content && e(a.content);
            }

            return n;
          }(p.tokens);
        }
      }
    }
  });
}(Prism);
!function (n) {
  n.languages.php = n.languages.extend("clike", {
    keyword: /\b(?:__halt_compiler|abstract|and|array|as|break|callable|case|catch|class|clone|const|continue|declare|default|die|do|echo|else|elseif|empty|enddeclare|endfor|endforeach|endif|endswitch|endwhile|eval|exit|extends|final|finally|for|foreach|function|global|goto|if|implements|include|include_once|instanceof|insteadof|interface|isset|list|namespace|new|or|parent|print|private|protected|public|require|require_once|return|static|switch|throw|trait|try|unset|use|var|while|xor|yield)\b/i,
    "boolean": {
      pattern: /\b(?:false|true)\b/i,
      alias: "constant"
    },
    constant: [/\b[A-Z_][A-Z0-9_]*\b/, /\b(?:null)\b/i],
    comment: {
      pattern: /(^|[^\\])(?:\/\*[\s\S]*?\*\/|\/\/.*)/,
      lookbehind: !0
    }
  }), n.languages.insertBefore("php", "string", {
    "shell-comment": {
      pattern: /(^|[^\\])#.*/,
      lookbehind: !0,
      alias: "comment"
    }
  }), n.languages.insertBefore("php", "comment", {
    delimiter: {
      pattern: /\?>$|^<\?(?:php(?=\s)|=)?/i,
      alias: "important"
    }
  }), n.languages.insertBefore("php", "keyword", {
    variable: /\$+(?:\w+\b|(?={))/i,
    "package": {
      pattern: /(\\|namespace\s+|use\s+)[\w\\]+/,
      lookbehind: !0,
      inside: {
        punctuation: /\\/
      }
    }
  }), n.languages.insertBefore("php", "operator", {
    property: {
      pattern: /(->)[\w]+/,
      lookbehind: !0
    }
  });
  var e = {
    pattern: /{\$(?:{(?:{[^{}]+}|[^{}]+)}|[^{}])+}|(^|[^\\{])\$+(?:\w+(?:\[.+?]|->\w+)*)/,
    lookbehind: !0,
    inside: n.languages.php
  };
  n.languages.insertBefore("php", "string", {
    "nowdoc-string": {
      pattern: /<<<'([^']+)'(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;/,
      greedy: !0,
      alias: "string",
      inside: {
        delimiter: {
          pattern: /^<<<'[^']+'|[a-z_]\w*;$/i,
          alias: "symbol",
          inside: {
            punctuation: /^<<<'?|[';]$/
          }
        }
      }
    },
    "heredoc-string": {
      pattern: /<<<(?:"([^"]+)"(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\1;|([a-z_]\w*)(?:\r\n?|\n)(?:.*(?:\r\n?|\n))*?\2;)/i,
      greedy: !0,
      alias: "string",
      inside: {
        delimiter: {
          pattern: /^<<<(?:"[^"]+"|[a-z_]\w*)|[a-z_]\w*;$/i,
          alias: "symbol",
          inside: {
            punctuation: /^<<<"?|[";]$/
          }
        },
        interpolation: e
      }
    },
    "single-quoted-string": {
      pattern: /'(?:\\[\s\S]|[^\\'])*'/,
      greedy: !0,
      alias: "string"
    },
    "double-quoted-string": {
      pattern: /"(?:\\[\s\S]|[^\\"])*"/,
      greedy: !0,
      alias: "string",
      inside: {
        interpolation: e
      }
    }
  }), delete n.languages.php.string, n.hooks.add("before-tokenize", function (e) {
    if (/<\?/.test(e.code)) {
      n.languages["markup-templating"].buildPlaceholders(e, "php", /<\?(?:[^"'/#]|\/(?![*/])|("|')(?:\\[\s\S]|(?!\1)[^\\])*\1|(?:\/\/|#)(?:[^?\n\r]|\?(?!>))*|\/\*[\s\S]*?(?:\*\/|$))*?(?:\?>|$)/gi);
    }
  }), n.hooks.add("after-tokenize", function (e) {
    n.languages["markup-templating"].tokenizePlaceholders(e, "php");
  });
}(Prism);
Prism.languages.insertBefore("php", "variable", {
  "this": /\$this\b/,
  global: /\$(?:_(?:SERVER|GET|POST|FILES|REQUEST|SESSION|ENV|COOKIE)|GLOBALS|HTTP_RAW_POST_DATA|argc|argv|php_errormsg|http_response_header)\b/,
  scope: {
    pattern: /\b[\w\\]+::/,
    inside: {
      keyword: /static|self|parent/,
      punctuation: /::|\\/
    }
  }
});
!function () {
  if ("undefined" != typeof self && self.Prism && self.document && document.querySelector) {
    var t,
        n = function n() {
      if (void 0 === t) {
        var e = document.createElement("div");
        e.style.fontSize = "13px", e.style.lineHeight = "1.5", e.style.padding = 0, e.style.border = 0, e.innerHTML = "&nbsp;<br />&nbsp;", document.body.appendChild(e), t = 38 === e.offsetHeight, document.body.removeChild(e);
      }

      return t;
    },
        a = 0;

    Prism.hooks.add("before-sanity-check", function (e) {
      var t = e.element.parentNode,
          n = t && t.getAttribute("data-line");

      if (t && n && /pre/i.test(t.nodeName)) {
        var i = 0;
        r(".line-highlight", t).forEach(function (e) {
          i += e.textContent.length, e.parentNode.removeChild(e);
        }), i && /^( \n)+$/.test(e.code.slice(-i)) && (e.code = e.code.slice(0, -i));
      }
    }), Prism.hooks.add("complete", function e(t) {
      var n = t.element.parentNode,
          i = n && n.getAttribute("data-line");

      if (n && i && /pre/i.test(n.nodeName)) {
        clearTimeout(a);
        var r = Prism.plugins.lineNumbers,
            o = t.plugins && t.plugins.lineNumbers;
        if (l(n, "line-numbers") && r && !o) Prism.hooks.add("line-numbers", e);else s(n, i)(), a = setTimeout(u, 1);
      }
    }), window.addEventListener("hashchange", u), window.addEventListener("resize", function () {
      var t = [];
      r("pre[data-line]").forEach(function (e) {
        t.push(s(e));
      }), t.forEach(i);
    });
  }

  function r(e, t) {
    return Array.prototype.slice.call((t || document).querySelectorAll(e));
  }

  function l(e, t) {
    return t = " " + t + " ", -1 < (" " + e.className + " ").replace(/[\n\t]/g, " ").indexOf(t);
  }

  function i(e) {
    e();
  }

  function s(u, e, d) {
    var t = (e = "string" == typeof e ? e : u.getAttribute("data-line")).replace(/\s+/g, "").split(","),
        c = +u.getAttribute("data-line-offset") || 0,
        f = (n() ? parseInt : parseFloat)(getComputedStyle(u).lineHeight),
        h = l(u, "line-numbers"),
        p = h ? u : u.querySelector("code") || u,
        m = [];
    return t.forEach(function (e) {
      var t = e.split("-"),
          n = +t[0],
          i = +t[1] || n,
          r = u.querySelector('.line-highlight[data-range="' + e + '"]') || document.createElement("div");

      if (m.push(function () {
        r.setAttribute("aria-hidden", "true"), r.setAttribute("data-range", e), r.className = (d || "") + " line-highlight";
      }), h && Prism.plugins.lineNumbers) {
        var o = Prism.plugins.lineNumbers.getLine(u, n),
            a = Prism.plugins.lineNumbers.getLine(u, i);

        if (o) {
          var l = o.offsetTop + "px";
          m.push(function () {
            r.style.top = l;
          });
        }

        if (a) {
          var s = a.offsetTop - o.offsetTop + a.offsetHeight + "px";
          m.push(function () {
            r.style.height = s;
          });
        }
      } else m.push(function () {
        r.setAttribute("data-start", n), n < i && r.setAttribute("data-end", i), r.style.top = (n - c - 1) * f + "px", r.textContent = new Array(i - n + 2).join(" \n");
      });

      m.push(function () {
        p.appendChild(r);
      });
    }), function () {
      m.forEach(i);
    };
  }

  function u() {
    var e = location.hash.slice(1);
    r(".temporary.line-highlight").forEach(function (e) {
      e.parentNode.removeChild(e);
    });
    var t = (e.match(/\.([\d,-]+)$/) || [, ""])[1];

    if (t && !document.getElementById(e)) {
      var n = e.slice(0, e.lastIndexOf(".")),
          i = document.getElementById(n);
      if (i) i.hasAttribute("data-line") || i.setAttribute("data-line", ""), s(i, t, "temporary ")(), document.querySelector(".temporary.line-highlight").scrollIntoView();
    }
  }
}();
!function () {
  if (("undefined" == typeof self || self.Prism) && ("undefined" == typeof __webpack_require__.g || __webpack_require__.g.Prism)) {
    var t = /\b([a-z]{3,7}:\/\/|tel:)[\w\-+%~/.:=&@]+(?:\?[\w\-+%~/.:=?&!$'()*,;@]*)?(?:#[\w\-+%~/.:#=?&!$'()*,;@]*)?/,
        r = /\b\S+@[\w.]+[a-z]{2}/,
        a = /\[([^\]]+)]\(([^)]+)\)/,
        l = ["comment", "url", "attr-value", "string"];
    Prism.plugins.autolinker = {
      processGrammar: function processGrammar(i) {
        i && !i["url-link"] && (Prism.languages.DFS(i, function (i, n, e) {
          -1 < l.indexOf(e) && !Array.isArray(n) && (n.pattern || (n = this[i] = {
            pattern: n
          }), n.inside = n.inside || {}, "comment" == e && (n.inside["md-link"] = a), "attr-value" == e ? Prism.languages.insertBefore("inside", "punctuation", {
            "url-link": t
          }, n) : n.inside["url-link"] = t, n.inside["email-link"] = r);
        }), i["url-link"] = t, i["email-link"] = r);
      }
    }, Prism.hooks.add("before-highlight", function (i) {
      Prism.plugins.autolinker.processGrammar(i.grammar);
    }), Prism.hooks.add("wrap", function (i) {
      if (/-link$/.test(i.type)) {
        i.tag = "a";
        var n = i.content;
        if ("email-link" == i.type && 0 != n.indexOf("mailto:")) n = "mailto:" + n;else if ("md-link" == i.type) {
          var e = i.content.match(a);
          n = e[2], i.content = e[1];
        }
        i.attributes.href = n;

        try {
          i.content = decodeURIComponent(i.content);
        } catch (i) {}
      }
    });
  }
}();
!function () {
  if (("undefined" == typeof self || self.Prism) && ("undefined" == typeof __webpack_require__.g || __webpack_require__.g.Prism)) {
    var r = {
      pattern: /(.)\bdata:[^\/]+\/[^,]+,(?:(?!\1)[\s\S]|\\\1)+(?=\1)/,
      lookbehind: !0,
      inside: {
        "language-css": {
          pattern: /(data:[^\/]+\/(?:[^+,]+\+)?css,)[\s\S]+/,
          lookbehind: !0
        },
        "language-javascript": {
          pattern: /(data:[^\/]+\/(?:[^+,]+\+)?javascript,)[\s\S]+/,
          lookbehind: !0
        },
        "language-json": {
          pattern: /(data:[^\/]+\/(?:[^+,]+\+)?json,)[\s\S]+/,
          lookbehind: !0
        },
        "language-markup": {
          pattern: /(data:[^\/]+\/(?:[^+,]+\+)?(?:html|xml),)[\s\S]+/,
          lookbehind: !0
        }
      }
    },
        e = ["url", "attr-value", "string"];
    Prism.plugins.dataURIHighlight = {
      processGrammar: function processGrammar(i) {
        i && !i["data-uri"] && (Prism.languages.DFS(i, function (i, a, n) {
          -1 < e.indexOf(n) && !Array.isArray(a) && (a.pattern || (a = this[i] = {
            pattern: a
          }), a.inside = a.inside || {}, "attr-value" == n ? Prism.languages.insertBefore("inside", a.inside["url-link"] ? "url-link" : "punctuation", {
            "data-uri": r
          }, a) : a.inside["url-link"] ? Prism.languages.insertBefore("inside", "url-link", {
            "data-uri": r
          }, a) : a.inside["data-uri"] = r);
        }), i["data-uri"] = r);
      }
    }, Prism.hooks.add("before-highlight", function (i) {
      if (r.pattern.test(i.code)) for (var a in r.inside) {
        if (r.inside.hasOwnProperty(a) && !r.inside[a].inside && r.inside[a].pattern.test(i.code)) {
          var n = a.match(/^language-(.+)/)[1];
          Prism.languages[n] && (r.inside[a].inside = {
            rest: (e = Prism.languages[n], Prism.plugins.autolinker && Prism.plugins.autolinker.processGrammar(e), e)
          });
        }
      }
      var e;
      Prism.plugins.dataURIHighlight.processGrammar(i.grammar);
    });
  }
}();
!function () {
  if ("undefined" != typeof self && self.Prism || "undefined" != typeof __webpack_require__.g && __webpack_require__.g.Prism) {
    var n = function n(_n) {
      return _n;
    },
        s = {
      classMap: n,
      prefixString: ""
    };

    Prism.plugins.customClass = {
      map: function map(i) {
        s.classMap = "function" == typeof i ? i : function (n) {
          return i[n] || n;
        };
      },
      prefix: function prefix(n) {
        s.prefixString = n;
      }
    }, Prism.hooks.add("wrap", function (i) {
      (s.classMap !== n || s.prefixString) && (i.classes = i.classes.map(function (n) {
        return s.prefixString + s.classMap(n, i.language);
      }));
    });
  }
}();
"undefined" != typeof self && self.Prism && self.document && document.querySelector && (self.Prism.fileHighlight = function (e) {
  e = e || document;
  var i = {
    js: "javascript",
    py: "python",
    rb: "ruby",
    ps1: "powershell",
    psm1: "powershell",
    sh: "bash",
    bat: "batch",
    h: "c",
    tex: "latex"
  };
  Array.prototype.slice.call(e.querySelectorAll("pre[data-src]")).forEach(function (e) {
    if (!e.hasAttribute("data-src-loaded")) {
      for (var t, a = e.getAttribute("data-src"), s = e, n = /\blang(?:uage)?-([\w-]+)\b/i; s && !n.test(s.className);) {
        s = s.parentNode;
      }

      if (s && (t = (e.className.match(n) || [, ""])[1]), !t) {
        var r = (a.match(/\.(\w+)$/) || [, ""])[1];
        t = i[r] || r;
      }

      var o = document.createElement("code");
      o.className = "language-" + t, e.textContent = "", o.textContent = "Loading…", e.appendChild(o);
      var l = new XMLHttpRequest();
      l.open("GET", a, !0), l.onreadystatechange = function () {
        4 == l.readyState && (l.status < 400 && l.responseText ? (o.textContent = l.responseText, Prism.highlightElement(o), e.setAttribute("data-src-loaded", "")) : 400 <= l.status ? o.textContent = "✖ Error " + l.status + " while fetching file: " + l.statusText : o.textContent = "✖ Error: File does not exist or is empty");
      }, l.send(null);
    }
  });
}, document.addEventListener("DOMContentLoaded", function () {
  self.Prism.fileHighlight();
}));
!function () {
  if ("undefined" != typeof self && self.Prism && self.document) {
    var r = [],
        i = {},
        a = function a() {};

    Prism.plugins.toolbar = {};

    var t = Prism.plugins.toolbar.registerButton = function (t, a) {
      var e;
      e = "function" == typeof a ? a : function (t) {
        var e;
        return "function" == typeof a.onClick ? ((e = document.createElement("button")).type = "button", e.addEventListener("click", function () {
          a.onClick.call(this, t);
        })) : "string" == typeof a.url ? (e = document.createElement("a")).href = a.url : e = document.createElement("span"), a.className && e.classList.add(a.className), e.textContent = a.text, e;
      }, t in i ? console.warn('There is a button with the key "' + t + '" registered already.') : r.push(i[t] = e);
    },
        e = Prism.plugins.toolbar.hook = function (n) {
      var t = n.element.parentNode;

      if (t && /pre/i.test(t.nodeName) && !t.parentNode.classList.contains("code-toolbar")) {
        var e = document.createElement("div");
        e.classList.add("code-toolbar"), t.parentNode.insertBefore(e, t), e.appendChild(t);
        var o = document.createElement("div");
        o.classList.add("toolbar"), document.body.hasAttribute("data-toolbar-order") && (r = document.body.getAttribute("data-toolbar-order").split(",").map(function (t) {
          return i[t] || a;
        })), r.forEach(function (t) {
          var e = t(n);

          if (e) {
            var a = document.createElement("div");
            a.classList.add("toolbar-item"), a.appendChild(e), o.appendChild(a);
          }
        }), e.appendChild(o);
      }
    };

    t("label", function (t) {
      var e = t.element.parentNode;

      if (e && /pre/i.test(e.nodeName) && e.hasAttribute("data-label")) {
        var a,
            n,
            o = e.getAttribute("data-label");

        try {
          n = document.querySelector("template#" + o);
        } catch (t) {}

        return n ? a = n.content : (e.hasAttribute("data-url") ? (a = document.createElement("a")).href = e.getAttribute("data-url") : a = document.createElement("span"), a.textContent = o), a;
      }
    }), Prism.hooks.add("complete", e);
  }
}();
"undefined" != typeof self && !self.Prism || "undefined" != typeof __webpack_require__.g && !__webpack_require__.g.Prism || Prism.hooks.add("wrap", function (e) {
  "keyword" === e.type && e.classes.push("keyword-" + e.content);
});
!function () {
  if ("undefined" != typeof self && "undefined" != typeof Prism && "undefined" != typeof document) {
    var i = /<\/?(?!\d)[^\s>\/=$<%]+(?:\s(?:\s*[^\s>\/=]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+(?=[\s>]))|(?=[\s/>])))+)?\s*\/?>/g,
        t = /^#?(?=(?:[\da-f]{1,2}){3,4}$)([\da-f][\da-f]?)([\da-f][\da-f]?)([\da-f][\da-f]?)([\da-f][\da-f]?)?$/i,
        d = [function (n) {
      var e = t.exec(n);

      if (e) {
        var o = n.length <= 4 ? 1 / 15 : 1 / 255;
        return "rgba(" + e.slice(1, 4).map(function (n) {
          return String(Math.round(parseInt(n, 16) * o * 255));
        }).join(",") + "," + (void 0 === e[4] ? "1" : (parseInt(e[4], 16) * o).toFixed(3)) + ")";
      }
    }, function (n) {
      var e = new Option().style;
      return e.color = n, e.color ? n : void 0;
    }];
    Prism.hooks.add("wrap", function (n) {
      if ("color" === n.type || "hexcode" === n.type) {
        for (var e, o = n.content, t = o.split(i).join(""), r = 0, a = d.length; r < a && !e; r++) {
          e = d[r](t);
        }

        if (!e) return;
        var f = '<span class="inline-color" style="background-color:' + e + ';"></span>';
        n.content = f + o;
      }
    });
  }
}();
!function () {
  if ("undefined" != typeof self && self.Prism && self.document && document.createElement) {
    var c = {
      javascript: "clike",
      actionscript: "javascript",
      arduino: "cpp",
      aspnet: ["markup", "csharp"],
      bison: "c",
      c: "clike",
      csharp: "clike",
      cpp: "c",
      coffeescript: "javascript",
      crystal: "ruby",
      "css-extras": "css",
      d: "clike",
      dart: "clike",
      django: "markup-templating",
      ejs: ["javascript", "markup-templating"],
      etlua: ["lua", "markup-templating"],
      erb: ["ruby", "markup-templating"],
      fsharp: "clike",
      "firestore-security-rules": "clike",
      flow: "javascript",
      ftl: "markup-templating",
      glsl: "clike",
      gml: "clike",
      go: "clike",
      groovy: "clike",
      haml: "ruby",
      handlebars: "markup-templating",
      haxe: "clike",
      java: "clike",
      javadoc: ["markup", "java", "javadoclike"],
      jolie: "clike",
      jsdoc: ["javascript", "javadoclike"],
      "js-extras": "javascript",
      "js-templates": "javascript",
      jsonp: "json",
      json5: "json",
      kotlin: "clike",
      less: "css",
      lilypond: "scheme",
      markdown: "markup",
      "markup-templating": "markup",
      n4js: "javascript",
      nginx: "clike",
      objectivec: "c",
      opencl: "cpp",
      parser: "markup",
      php: ["clike", "markup-templating"],
      phpdoc: ["php", "javadoclike"],
      "php-extras": "php",
      plsql: "sql",
      processing: "clike",
      protobuf: "clike",
      pug: ["markup", "javascript"],
      qore: "clike",
      jsx: ["markup", "javascript"],
      tsx: ["jsx", "typescript"],
      reason: "clike",
      ruby: "clike",
      sass: "css",
      scss: "css",
      scala: "java",
      "shell-session": "bash",
      smarty: "markup-templating",
      solidity: "clike",
      soy: "markup-templating",
      sparql: "turtle",
      sqf: "clike",
      swift: "clike",
      tap: "yaml",
      textile: "markup",
      tt2: ["clike", "markup-templating"],
      twig: "markup",
      typescript: "javascript",
      "t4-cs": ["t4-templating", "csharp"],
      "t4-vb": ["t4-templating", "visual-basic"],
      vala: "clike",
      vbnet: "basic",
      velocity: "markup",
      wiki: "markup",
      xeora: "markup",
      xquery: "markup"
    },
        l = {
      html: "markup",
      xml: "markup",
      svg: "markup",
      mathml: "markup",
      js: "javascript",
      g4: "antlr4",
      adoc: "asciidoc",
      shell: "bash",
      rbnf: "bnf",
      cs: "csharp",
      dotnet: "csharp",
      coffee: "coffeescript",
      jinja2: "django",
      "dns-zone": "dns-zone-file",
      dockerfile: "docker",
      gamemakerlanguage: "gml",
      hs: "haskell",
      tex: "latex",
      context: "latex",
      ly: "lilypond",
      emacs: "lisp",
      elisp: "lisp",
      "emacs-lisp": "lisp",
      md: "markdown",
      moon: "moonscript",
      n4jsd: "n4js",
      objectpascal: "pascal",
      px: "pcaxis",
      py: "python",
      robot: "robot-framework",
      rb: "ruby",
      rq: "sparql",
      trig: "turtle",
      ts: "typescript",
      t4: "t4-cs",
      vb: "visual-basic",
      xeoracube: "xeora",
      yml: "yaml"
    },
        n = {},
        a = "components/",
        e = Prism.util.currentScript();

    if (e) {
      var t = /\bplugins\/autoloader\/prism-autoloader\.(?:min\.)js$/i,
          s = /[\w-]+\.(?:min\.)js$/i;
      if (e.hasAttribute("data-autoloader-path")) a = e.getAttribute("data-autoloader-path").trim().replace(/\/?$/, "/");else {
        var i = e.src;
        t.test(i) ? a = i.replace(t, "components/") : s.test(i) && (a = i.replace(s, "components/"));
      }
    }

    var p = Prism.plugins.autoloader = {
      languages_path: a,
      use_minified: !0,
      loadLanguages: o
    };
    Prism.hooks.add("complete", function (a) {
      a.element && a.language && !a.grammar && "none" !== a.language && function (a, e) {
        a in l && (a = l[a]);
        var t = e.getAttribute("data-dependencies"),
            s = e.parentElement;
        !t && s && "pre" === s.tagName.toLowerCase() && (t = s.getAttribute("data-dependencies")), o(t = t ? t.split(/\s*,\s*/g) : [], function () {
          m(a, function () {
            Prism.highlightElement(e);
          });
        });
      }(a.language, a.element);
    });
  }

  function o(a, e, t) {
    "string" == typeof a && (a = [a]);
    var s = a.length,
        i = 0,
        r = !1;

    function c() {
      r || ++i === s && e && e(a);
    }

    0 !== s ? a.forEach(function (a) {
      m(a, c, function () {
        r || (r = !0, t && t(a));
      });
    }) : e && setTimeout(e, 0);
  }

  function m(e, t, s) {
    var i = 0 <= e.indexOf("!");
    e = e.replace("!", ""), e = l[e] || e;

    var a = function a() {
      var a = n[e];
      if (a || (a = n[e] = {
        callbacks: []
      }), a.callbacks.push({
        success: t,
        error: s
      }), !i && Prism.languages[e]) u(e, "success");else if (!i && a.error) u(e, "error");else if (i || !a.loading) {
        a.loading = !0, function (a, e, t) {
          var s = document.createElement("script");
          s.src = a, s.async = !0, s.onload = function () {
            document.body.removeChild(s), e && e();
          }, s.onerror = function () {
            document.body.removeChild(s), t && t();
          }, document.body.appendChild(s);
        }(function (a) {
          return p.languages_path + "prism-" + a + (p.use_minified ? ".min" : "") + ".js";
        }(e), function () {
          a.loading = !1, u(e, "success");
        }, function () {
          a.loading = !1, a.error = !0, u(e, "error");
        });
      }
    },
        r = c[e];

    r && r.length ? o(r, a, s) : a();
  }

  function u(a, e) {
    if (n[a]) {
      for (var t = n[a].callbacks, s = 0, i = t.length; s < i; s++) {
        var r = t[s][e];
        r && setTimeout(r, 0);
      }

      t.length = 0;
    }
  }
}();
!function () {
  if ("undefined" != typeof self && self.Prism && self.document) {
    var u = /(?:^|\s)command-line(?:\s|$)/;
    Prism.hooks.add("before-highlight", function (e) {
      var t = e.vars = e.vars || {},
          a = t["command-line"] = t["command-line"] || {};

      if (!a.complete && e.code) {
        var n = e.element.parentNode;
        if (n && /pre/i.test(n.nodeName) && (u.test(n.className) || u.test(e.element.className))) {
          if (e.element.querySelector(".command-line-prompt")) a.complete = !0;else {
            var r = e.code.split("\n");
            a.numberOfLines = r.length;
            var s = a.outputLines = [],
                o = n.getAttribute("data-output"),
                i = n.getAttribute("data-filter-output");

            if (o || "" === o) {
              o = o.split(",");

              for (var l = 0; l < o.length; l++) {
                var m = o[l].split("-"),
                    p = parseInt(m[0], 10),
                    d = 2 === m.length ? parseInt(m[1], 10) : p;

                if (!isNaN(p) && !isNaN(d)) {
                  p < 1 && (p = 1), d > r.length && (d = r.length), d--;

                  for (var c = --p; c <= d; c++) {
                    s[c] = r[c], r[c] = "";
                  }
                }
              }
            } else if (i) for (l = 0; l < r.length; l++) {
              0 === r[l].indexOf(i) && (s[l] = r[l].slice(i.length), r[l] = "");
            }

            e.code = r.join("\n");
          }
        } else a.complete = !0;
      } else a.complete = !0;
    }), Prism.hooks.add("before-insert", function (e) {
      var t = e.vars = e.vars || {},
          a = t["command-line"] = t["command-line"] || {};

      if (!a.complete) {
        for (var n = e.highlightedCode.split("\n"), r = 0, s = (a.outputLines || []).length; r < s; r++) {
          a.outputLines.hasOwnProperty(r) && (n[r] = a.outputLines[r]);
        }

        e.highlightedCode = n.join("\n");
      }
    }), Prism.hooks.add("complete", function (e) {
      var t = e.vars = e.vars || {},
          a = t["command-line"] = t["command-line"] || {};

      if (!a.complete) {
        var n = e.element.parentNode;
        u.test(e.element.className) && (e.element.className = e.element.className.replace(u, " ")), u.test(n.className) || (n.className += " command-line");

        var r = function r(e, t) {
          return (n.getAttribute(e) || t).replace(/"/g, "&quot");
        },
            s = new Array((a.numberOfLines || 0) + 1),
            o = r("data-prompt", "");

        if ("" !== o) s = s.join('<span data-prompt="' + o + '"></span>');else {
          var i = r("data-user", "user"),
              l = r("data-host", "localhost");
          s = s.join('<span data-user="' + i + '" data-host="' + l + '"></span>');
        }
        var m = document.createElement("span");
        m.className = "command-line-prompt", m.innerHTML = s;

        for (var p = 0, d = (a.outputLines || []).length; p < d; p++) {
          if (a.outputLines.hasOwnProperty(p)) {
            var c = m.children[p];
            c.removeAttribute("data-user"), c.removeAttribute("data-host"), c.removeAttribute("data-prompt");
          }
        }

        e.element.insertBefore(m, e.element.firstChild), a.complete = !0;
      }
    });
  }
}();
!function () {
  var i = Object.assign || function (e, n) {
    for (var t in n) {
      n.hasOwnProperty(t) && (e[t] = n[t]);
    }

    return e;
  };

  function e(e) {
    this.defaults = i({}, e);
  }

  function l(e) {
    for (var n = 0, t = 0; t < e.length; ++t) {
      e.charCodeAt(t) == "\t".charCodeAt(0) && (n += 3);
    }

    return e.length + n;
  }

  e.prototype = {
    setDefaults: function setDefaults(e) {
      this.defaults = i(this.defaults, e);
    },
    normalize: function normalize(e, n) {
      for (var t in n = i(this.defaults, n)) {
        var r = t.replace(/-(\w)/g, function (e, n) {
          return n.toUpperCase();
        });
        "normalize" !== t && "setDefaults" !== r && n[t] && this[r] && (e = this[r].call(this, e, n[t]));
      }

      return e;
    },
    leftTrim: function leftTrim(e) {
      return e.replace(/^\s+/, "");
    },
    rightTrim: function rightTrim(e) {
      return e.replace(/\s+$/, "");
    },
    tabsToSpaces: function tabsToSpaces(e, n) {
      return n = 0 | n || 4, e.replace(/\t/g, new Array(++n).join(" "));
    },
    spacesToTabs: function spacesToTabs(e, n) {
      return n = 0 | n || 4, e.replace(RegExp(" {" + n + "}", "g"), "\t");
    },
    removeTrailing: function removeTrailing(e) {
      return e.replace(/\s*?$/gm, "");
    },
    removeInitialLineFeed: function removeInitialLineFeed(e) {
      return e.replace(/^(?:\r?\n|\r)/, "");
    },
    removeIndent: function removeIndent(e) {
      var n = e.match(/^[^\S\n\r]*(?=\S)/gm);
      return n && n[0].length ? (n.sort(function (e, n) {
        return e.length - n.length;
      }), n[0].length ? e.replace(RegExp("^" + n[0], "gm"), "") : e) : e;
    },
    indent: function indent(e, n) {
      return e.replace(/^[^\S\n\r]*(?=\S)/gm, new Array(++n).join("\t") + "$&");
    },
    breakLines: function breakLines(e, n) {
      n = !0 === n ? 80 : 0 | n || 80;

      for (var t = e.split("\n"), r = 0; r < t.length; ++r) {
        if (!(l(t[r]) <= n)) {
          for (var i = t[r].split(/(\s+)/g), o = 0, a = 0; a < i.length; ++a) {
            var s = l(i[a]);
            n < (o += s) && (i[a] = "\n" + i[a], o = s);
          }

          t[r] = i.join("");
        }
      }

      return t.join("\n");
    }
  },  true && module.exports && (module.exports = e), "undefined" != typeof Prism && (Prism.plugins.NormalizeWhitespace = new e({
    "remove-trailing": !0,
    "remove-indent": !0,
    "left-trim": !0,
    "right-trim": !0
  }), Prism.hooks.add("before-sanity-check", function (e) {
    var n = Prism.plugins.NormalizeWhitespace;
    if (!e.settings || !1 !== e.settings["whitespace-normalization"]) if (e.element && e.element.parentNode || !e.code) {
      var t = e.element.parentNode,
          r = /(?:^|\s)no-whitespace-normalization(?:\s|$)/;

      if (e.code && t && "pre" === t.nodeName.toLowerCase() && !r.test(t.className) && !r.test(e.element.className)) {
        for (var i = t.childNodes, o = "", a = "", s = !1, l = 0; l < i.length; ++l) {
          var c = i[l];
          c == e.element ? s = !0 : "#text" === c.nodeName && (s ? a += c.nodeValue : o += c.nodeValue, t.removeChild(c), --l);
        }

        if (e.element.children.length && Prism.plugins.KeepMarkup) {
          var u = o + e.element.innerHTML + a;
          e.element.innerHTML = n.normalize(u, e.settings), e.code = e.element.textContent;
        } else e.code = o + e.code + a, e.code = n.normalize(e.code, e.settings);
      }
    } else e.code = n.normalize(e.code, e.settings);
  }));
}();
!function () {
  if (("undefined" == typeof self || self.Prism) && ("undefined" == typeof __webpack_require__.g || __webpack_require__.g.Prism)) {
    var i = {
      tab: /\t/,
      crlf: /\r\n/,
      lf: /\n/,
      cr: /\r/,
      space: / /
    };
    Prism.hooks.add("before-highlight", function (r) {
      s(r.grammar);
    });
  }

  function f(r, e) {
    var i = r[e];

    switch (Prism.util.type(i)) {
      case "RegExp":
        var a = {};
        r[e] = {
          pattern: i,
          inside: a
        }, s(a);
        break;

      case "Array":
        for (var n = 0, t = i.length; n < t; n++) {
          f(i, n);
        }

        break;

      default:
        s(a = i.inside || (i.inside = {}));
    }
  }

  function s(r) {
    if (r && !r.tab) {
      for (var e in i) {
        i.hasOwnProperty(e) && (r[e] = i[e]);
      }

      for (var e in r) {
        r.hasOwnProperty(e) && !i[e] && ("rest" === e ? s(r.rest) : f(r, e));
      }
    }
  }
}();
!function () {
  if ("undefined" != typeof self && self.Prism && self.document) if (Prism.plugins.toolbar) {
    var r = {
      html: "HTML",
      xml: "XML",
      svg: "SVG",
      mathml: "MathML",
      css: "CSS",
      clike: "C-like",
      js: "JavaScript",
      abap: "ABAP",
      abnf: "Augmented Backus–Naur form",
      antlr4: "ANTLR4",
      g4: "ANTLR4",
      apacheconf: "Apache Configuration",
      apl: "APL",
      aql: "AQL",
      arff: "ARFF",
      asciidoc: "AsciiDoc",
      adoc: "AsciiDoc",
      asm6502: "6502 Assembly",
      aspnet: "ASP.NET (C#)",
      autohotkey: "AutoHotkey",
      autoit: "AutoIt",
      shell: "Bash",
      basic: "BASIC",
      bbcode: "BBcode",
      bnf: "Backus–Naur form",
      rbnf: "Routing Backus–Naur form",
      csharp: "C#",
      cs: "C#",
      dotnet: "C#",
      cpp: "C++",
      cil: "CIL",
      coffee: "CoffeeScript",
      cmake: "CMake",
      csp: "Content-Security-Policy",
      "css-extras": "CSS Extras",
      django: "Django/Jinja2",
      jinja2: "Django/Jinja2",
      "dns-zone-file": "DNS zone file",
      "dns-zone": "DNS zone file",
      dockerfile: "Docker",
      ebnf: "Extended Backus–Naur form",
      ejs: "EJS",
      etlua: "Embedded Lua templating",
      erb: "ERB",
      fsharp: "F#",
      "firestore-security-rules": "Firestore security rules",
      ftl: "FreeMarker Template Language",
      gcode: "G-code",
      gdscript: "GDScript",
      gedcom: "GEDCOM",
      glsl: "GLSL",
      gml: "GameMaker Language",
      gamemakerlanguage: "GameMaker Language",
      graphql: "GraphQL",
      hs: "Haskell",
      hcl: "HCL",
      http: "HTTP",
      hpkp: "HTTP Public-Key-Pins",
      hsts: "HTTP Strict-Transport-Security",
      ichigojam: "IchigoJam",
      inform7: "Inform 7",
      javadoc: "JavaDoc",
      javadoclike: "JavaDoc-like",
      javastacktrace: "Java stack trace",
      jq: "JQ",
      jsdoc: "JSDoc",
      "js-extras": "JS Extras",
      "js-templates": "JS Templates",
      json: "JSON",
      jsonp: "JSONP",
      json5: "JSON5",
      latex: "LaTeX",
      tex: "TeX",
      context: "ConTeXt",
      lilypond: "LilyPond",
      ly: "LilyPond",
      emacs: "Lisp",
      elisp: "Lisp",
      "emacs-lisp": "Lisp",
      lolcode: "LOLCODE",
      md: "Markdown",
      "markup-templating": "Markup templating",
      matlab: "MATLAB",
      mel: "MEL",
      moon: "MoonScript",
      n1ql: "N1QL",
      n4js: "N4JS",
      n4jsd: "N4JS",
      "nand2tetris-hdl": "Nand To Tetris HDL",
      nasm: "NASM",
      nginx: "nginx",
      nsis: "NSIS",
      objectivec: "Objective-C",
      ocaml: "OCaml",
      opencl: "OpenCL",
      parigp: "PARI/GP",
      objectpascal: "Object Pascal",
      pcaxis: "PC-Axis",
      px: "PC-Axis",
      php: "PHP",
      phpdoc: "PHPDoc",
      "php-extras": "PHP Extras",
      plsql: "PL/SQL",
      powershell: "PowerShell",
      properties: ".properties",
      protobuf: "Protocol Buffers",
      py: "Python",
      q: "Q (kdb+ database)",
      jsx: "React JSX",
      tsx: "React TSX",
      renpy: "Ren'py",
      rest: "reST (reStructuredText)",
      "robot-framework": "Robot Framework",
      robot: "Robot Framework",
      rb: "Ruby",
      sas: "SAS",
      sass: "Sass (Sass)",
      scss: "Sass (Scss)",
      "shell-session": "Shell session",
      solidity: "Solidity (Ethereum)",
      soy: "Soy (Closure Template)",
      sparql: "SPARQL",
      rq: "SPARQL",
      "splunk-spl": "Splunk SPL",
      sqf: "SQF: Status Quo Function (Arma 3)",
      sql: "SQL",
      tap: "TAP",
      toml: "TOML",
      tt2: "Template Toolkit 2",
      trig: "TriG",
      ts: "TypeScript",
      "t4-cs": "T4 Text Templates (C#)",
      t4: "T4 Text Templates (C#)",
      "t4-vb": "T4 Text Templates (VB)",
      "t4-templating": "T4 templating",
      vbnet: "VB.Net",
      vhdl: "VHDL",
      vim: "vim",
      "visual-basic": "Visual Basic",
      vb: "Visual Basic",
      wasm: "WebAssembly",
      wiki: "Wiki markup",
      xeoracube: "XeoraCube",
      xojo: "Xojo (REALbasic)",
      xquery: "XQuery",
      yaml: "YAML",
      yml: "YAML"
    };
    Prism.plugins.toolbar.registerButton("show-language", function (e) {
      var a = e.element.parentNode;

      if (a && /pre/i.test(a.nodeName)) {
        var s,
            t = a.getAttribute("data-language") || r[e.language] || ((s = e.language) ? (s.substring(0, 1).toUpperCase() + s.substring(1)).replace(/s(?=cript)/, "S") : s);

        if (t) {
          var o = document.createElement("span");
          return o.textContent = t, o;
        }
      }
    });
  } else console.warn("Show Languages plugin loaded before Toolbar plugin.");
}();
!function () {
  if ("undefined" != typeof self && self.Prism && self.document) {
    var c = /(?:^|\s)match-braces(?:\s|$)/,
        a = /(?:^|\s)brace-hover(?:\s|$)/,
        l = /(?:^|\s)brace-selected(?:\s|$)/,
        n = /(?:^|\s)no-brace-hover(?:\s|$)/,
        t = /(?:^|\s)no-brace-select(?:\s|$)/,
        u = {
      "(": ")",
      "[": "]",
      "{": "}"
    },
        f = {
      "(": "brace-round",
      "[": "brace-square",
      "{": "brace-curly"
    },
        m = 0,
        r = /^(pair-\d+-)(open|close)$/;
    Prism.hooks.add("complete", function (e) {
      var a = e.element,
          n = a.parentElement;

      if (n && "PRE" == n.tagName) {
        for (var t = [], r = a; r; r = r.parentElement) {
          if (c.test(r.className)) {
            t.push("(", "[", "{");
            break;
          }
        }

        if (0 != t.length) {
          n.__listenerAdded || (n.addEventListener("mousedown", function () {
            var e = n.querySelector("code");
            Array.prototype.slice.call(e.querySelectorAll(".brace-selected")).forEach(function (e) {
              e.className = e.className.replace(l, " ");
            });
          }), Object.defineProperty(n, "__listenerAdded", {
            value: !0
          }));
          var o = Array.prototype.slice.call(a.querySelectorAll("span.token.punctuation")),
              i = [];
          t.forEach(function (e) {
            for (var a = u[e], n = f[e], t = [], r = [], s = 0; s < o.length; s++) {
              var c = o[s];

              if (0 == c.childElementCount) {
                var l = c.textContent;
                l === e ? (i.push({
                  index: s,
                  open: !0,
                  element: c
                }), c.className += " " + n, c.className += " brace-open", r.push(s)) : l === a && (i.push({
                  index: s,
                  open: !1,
                  element: c
                }), c.className += " " + n, c.className += " brace-close", r.length && t.push([s, r.pop()]));
              }
            }

            t.forEach(function (e) {
              var a = "pair-" + m++ + "-",
                  n = o[e[0]],
                  t = o[e[1]];
              n.id = a + "open", t.id = a + "close", [n, t].forEach(function (e) {
                e.addEventListener("mouseenter", p), e.addEventListener("mouseleave", d), e.addEventListener("click", h);
              });
            });
          });
          var s = 0;
          i.sort(function (e, a) {
            return e.index - a.index;
          }), i.forEach(function (e) {
            e.open ? (e.element.className += " brace-level-" + (s % 12 + 1), s++) : (s = Math.max(0, s - 1), e.element.className += " brace-level-" + (s % 12 + 1));
          });
        }
      }
    });
  }

  function s(e) {
    var a = r.exec(e.id);
    return document.querySelector("#" + a[1] + ("open" == a[2] ? "close" : "open"));
  }

  function p() {
    for (var e = this.parentElement; e; e = e.parentElement) {
      if (n.test(e.className)) return;
    }

    [this, s(this)].forEach(function (e) {
      e.className = (e.className.replace(a, " ") + " brace-hover").replace(/\s+/g, " ");
    });
  }

  function d() {
    [this, s(this)].forEach(function (e) {
      e.className = e.className.replace(a, " ");
    });
  }

  function h() {
    for (var e = this.parentElement; e; e = e.parentElement) {
      if (t.test(e.className)) return;
    }

    [this, s(this)].forEach(function (e) {
      e.className = (e.className.replace(l, " ") + " brace-selected").replace(/\s+/g, " ");
    });
  }
}();

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	(() => {
/******/ 		__webpack_require__.g = (function() {
/******/ 			if (typeof globalThis === 'object') return globalThis;
/******/ 			try {
/******/ 				return this || new Function('return this')();
/******/ 			} catch (e) {
/******/ 				if (typeof window === 'object') return window;
/******/ 			}
/******/ 		})();
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/resources/dist/js/app": 0,
/******/ 			"resources/dist/css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkIds[i]] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunklaravel_bootstrap_notify"] = self["webpackChunklaravel_bootstrap_notify"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["resources/dist/css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["resources/dist/css/app"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;