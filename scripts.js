(function() {
  'use strict';

  // Send an update signal when a task's status is changed via <select>
  document
    .querySelectorAll('.update-task-status, .update-order')
    .forEach(task => {
      task.querySelector('select').addEventListener('change', function() {
        this.parentNode.submit();
      });
    });
})();
