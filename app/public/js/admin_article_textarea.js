$(function() {
    var $textarea = $('#input_article_textarea');
    var lineHeight = parseInt($textarea.css('lineHeight'));

    $textarea.on('input', function(e) {
      var lines = ($(this).val() + '\n').match(/\n/g).length;
      if(lines >= 3){
        $(this).height(lineHeight * lines);
      }
    });
  });