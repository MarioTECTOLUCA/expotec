<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    (function() {
    "use strict";
  
    var sidebar = document.querySelector('.sidebar');
    var sidebarToggles = document.querySelectorAll('#sidebarToggle, #sidebarToggleTop');
    
    if (sidebar) {
      
      var collapseEl = sidebar.querySelector('.collapse');
      var collapseElementList = [].slice.call(document.querySelectorAll('.sidebar .collapse'))
      var sidebarCollapseList = collapseElementList.map(function (collapseEl) {
        return new bootstrap.Collapse(collapseEl, { toggle: false });
      });
  
      for (var toggle of sidebarToggles) {
        toggle.addEventListener('click', function(e) {
          document.body.classList.toggle('sidebar-toggled');
          sidebar.classList.toggle('toggled');
  
          if (sidebar.classList.contains('toggled')) {
            for (var bsCollapse of sidebarCollapseList) {
              bsCollapse.hide();
            }
          };
        });
      }
      window.addEventListener('resize', function() {
        var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
  
        if (vw < 768) {
          for (var bsCollapse of sidebarCollapseList) {
            bsCollapse.hide();
          }
        };
      });
    }
    var fixedNaigation = document.querySelector('body.fixed-nav .sidebar');
    
    if (fixedNaigation) {
      fixedNaigation.on('mousewheel DOMMouseScroll wheel', function(e) {
        var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
  
        if (vw > 768) {
          var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;
          this.scrollTop += (delta < 0 ? 1 : -1) * 30;
          e.preventDefault();
        }
      });
    }
  })();
</script>

@stack('scripts')
@notifyJs