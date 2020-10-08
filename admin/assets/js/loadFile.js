/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 
 function delete_student(refid)
 {
	 var r = confirm("Please Confirm ");
	 
		if (r == true) {
						
			loadContainer('../school/delStudent_filter.php?refid='+refid);
			
		} 
 }
 
//
 function delete_emp(refid)
 {
	 var r = confirm("Please Confirm ");
	 
		if (r == true) {
						
			loadContainer('../employee/delStudent_filter.php?refid='+refid);
			
		} 
 }

// 
function loadContainer(durl){
 $('#loadingmessage').hide();// show loading image
     $.ajax({
      url:durl,
      beforeSend:function(){
 $('#firstload').show();// show loading image
        //$('#content-replacer').fadeOut('slow');
      },
      success:function(data){
  $('#firstload').hide();// show loading image
        // do something with the return data if you have
        // the return data could be a plain-text, or HTML, or JSON, or JSONP, depends on your needs, if you do ha
        //console.log(data);
        $("#content-replacer").html(data);		
		
		    // Todo list
    $('.todo').on('click', 'li', function () {
      $(this).toggleClass('todo-done');
    });

    // Custom Selects
    if ($('[data-toggle="select"]').length) {
      $('[data-toggle="select"]').select2();
    }

    // Checkboxes and Radio buttons
    $('[data-toggle="checkbox"]').radiocheck();
    $('[data-toggle="radio"]').radiocheck();

    // Tooltips
    $('[data-toggle=tooltip]').tooltip('show');

    // jQuery UI Sliders
    var $slider = $('#slider');
    if ($slider.length > 0) {
      $slider.slider({
        max: 15,
        step: 6,
        value: 3,
        orientation: 'horizontal',
        range: 'min'
      }).addSliderSegments();
    }

    var $verticalSlider = $('#vertical-slider');
    if ($verticalSlider.length) {
      $verticalSlider.slider({
        min: 1,
        max: 5,
        value: 3,
        orientation: 'vertical',
        range: 'min'
      }).addSliderSegments($verticalSlider.slider('option').max, 'vertical');
    }

    // Focus state for append/prepend inputs
    $('.input-group').on('focus', '.form-control', function () {
      $(this).closest('.input-group, .form-group').addClass('focus');
    }).on('blur', '.form-control', function () {
      $(this).closest('.input-group, .form-group').removeClass('focus');
    });

    // Make pagination demo work
    $('.pagination').on('click', 'a', function () {
      $(this).parent().siblings('li').removeClass('active').end().addClass('active');
    });

    $('.btn-group').on('click', 'a', function () {
      $(this).siblings().removeClass('active').end().addClass('active');
    });

    // Disable link clicks to prevent page scrolling
    $(document).on('click', 'a[href="#fakelink"]', function (e) {
      e.preventDefault();
    });

    // Switches
    if ($('[data-toggle="switch"]').length) {
      $('[data-toggle="switch"]').bootstrapSwitch();
    }

    // Typeahead
    if ($('#typeahead-demo-01').length) {
      var states = new Bloodhound({
        datumTokenizer: function (d) { return Bloodhound.tokenizers.whitespace(d.word); },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 4,
        local: [
          { word: 'Alabama' },
          { word: 'Alaska' },
          { word: 'Arizona' },
          { word: 'Arkansas' },
          { word: 'California' },
          { word: 'Colorado' }
        ]
      });

      states.initialize();

      $('#typeahead-demo-01').typeahead(null, {
        name: 'states',
        displayKey: 'word',
        source: states.ttAdapter()
      });
    }

    // make code pretty
    window.prettyPrint && prettyPrint();
	
        //$('#content-replacer').fadeIn('slow');
		
		select_callll('areaa','Uncheck All');
      }
	  
    });    
}    

