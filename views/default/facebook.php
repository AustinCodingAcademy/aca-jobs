<script type="text/javascript">
$(function() {
  var parser = document.createElement('a');
  parser.href = window.location.href;
  var split = parser.pathname.split('/');
  var city = (split.indexOf('cities') > -1 && split[split.indexOf('cities') + 2] !== 'anywhere') ? split[split.indexOf('cities') + 2] : '';
  var category = split.indexOf('categories') > -1 ? split[split.indexOf('categories') + 2] : '';
  var query = split.indexOf('search') > -1 ? split[split.indexOf('search') + 1]: '';
  if (!city || city === 'austin') {
    $.ajax('/facebook/140685779475686', {
      data: {
        query: [query, category].filter(function(x) { return !!x; }).join('+')
      },
      success: function(res) {
        var str = '<h3>Capital Factory</h3>';
        str += '<div class="list-group" id="capital-factory"></div>';
        str += '<p class="pull-right"><a href="#top">^ back to top</a></p>';
        str += '<a name="capital-factory"></a>';
        $(str).insertAfter($('p.pull-right:not(.jobs2careers)').last());
        for (var idx in res) {
          var item = '<a class="list-group-item" data-toggle="modal" data-target="#myModal" data-idx="' + idx + '">';
          item +='<h4><div class="row"><div class="col-sm-9"><span class="job-title"></span>&nbsp;';
          item +='<span class="job-company">' + res[idx].company + '</span></div>';
          item +='<div class="col-sm-3"><span class="label label-warning pull-right">Capital Factory</span>';
          item += '<span class="label label-default pull-right">' + moment.utc(res[idx].updated_time).format('DD MMM YYYY') + '</span>';
          item +='<span class="label label-info pull-right">Austin, TX</span></div></div></h4></a>';
          $item = $(item);
          if ((!city && !category) || query) {
            $('#capital-factory').append($item);
          } else if (city === 'austin' || category) {
            $item.insertAfter($('.list-group-item:not(.jobs2careers)').last());
          }
          $item.click(function(e) {
            $('.modal-title').html(res[$(this).data('idx')].company + '<br />');
            $('.modal-title').append('<small>' + res[$(this).data('idx')].company + '</small>');
            $('.modal-body').html(res[$(this).data('idx')].message + '<br /><br />');
            $('#job-apply').attr('href', 'https://facebook.com/' + res[$(this).data('idx')].id);
          });
        }
      }
    });
  }
});
</script>
