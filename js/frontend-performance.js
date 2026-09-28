/**
 * Lightweight frontend performance patterns.
 *
 * This file demonstrates:
 * - event delegation instead of many listeners
 * - scheduling non-critical work during idle time
 * - avoiding repeated DOM queries
 *
 * Adapt selectors and behavior to the project.
 */

(() => {
  'use strict';

  /**
   * Schedule non-critical work without blocking startup.
   *
   * @param {Function} callback
   */
  const whenIdle = (callback) => {
    if ('requestIdleCallback' in window) {
      window.requestIdleCallback(callback, { timeout: 1500 });
      return;
    }

    window.setTimeout(callback, 1);
  };

  /**
   * One delegated listener can replace many equivalent listeners on child
   * elements. Keep delegated handlers cheap because they see many events.
   */
  document.addEventListener('click', (event) => {
    const trigger = event.target.closest('[data-performance-trigger]');

    if (!trigger) {
      return;
    }

    // Keep synchronous interaction work minimal.
    trigger.classList.toggle('is-active');
  });

  /**
   * Example of deferring a non-critical enhancement.
   */
  whenIdle(() => {
    const optionalWidgets = document.querySelectorAll('[data-idle-enhancement]');

    optionalWidgets.forEach((widget) => {
      widget.dataset.enhanced = 'true';
    });
  });
})();
