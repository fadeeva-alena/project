// Put each of your customised sliders here.
// window.document.sliders = [ { ... }, { ... }, ... ] = an array of objects.

var sliders = [

	    // First slider (and the only one in this template file)
	    {
	    interactive : false,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 5,			// all in 'px' pixels
	    top : 5,
	    pane_image: "pane.gif",

	    scale_width : 35,
	    scale_height : 3,		
	    scale_image : "scale.gif",

	    stylus_width : 6,
	    stylus_height : 10,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 5,
	    tick_width : 1,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 0,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	}
 
	// next slider goes here. copy { ... } from the first slider
	// and add a , before the new slider.
,
	    {
	    interactive : false,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 5,			// all in 'px' pixels
	    top : 5,
	    pane_image: "pane.gif",

	    scale_width : 35,
	    scale_height : 3,		
	    scale_image : "scale.gif",

	    stylus_width : 6,
	    stylus_height : 10,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 5,
	    tick_width : 1,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 1,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
	    {
	    interactive : false,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 5,			// all in 'px' pixels
	    top : 5,
	    pane_image: "pane.gif",

	    scale_width : 35,
	    scale_height : 3,		
	    scale_image : "scale.gif",

	    stylus_width : 6,
	    stylus_height : 10,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 5,
	    tick_width : 1,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 2,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
	    {
	    interactive : false,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 5,			// all in 'px' pixels
	    top : 5,
	    pane_image: "pane.gif",

	    scale_width : 35,
	    scale_height : 3,		
	    scale_image : "scale.gif",

	    stylus_width : 6,
	    stylus_height : 10,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 5,
	    tick_width : 1,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 3,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
	    {
	    interactive : false,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 5,			// all in 'px' pixels
	    top : 5,
	    pane_image: "pane.gif",

	    scale_width : 35,
	    scale_height : 3,		
	    scale_image : "scale.gif",

	    stylus_width : 6,
	    stylus_height : 10,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 5,
	    tick_width : 1,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 4,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
{
	    interactive : true,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider1",

	    left : 10,			// all in 'px' pixels
	    top : 10,
	    pane_image: "pane.gif",

	    scale_width : 50,
	    scale_height : 6,		
	    scale_image : "scale.gif",

	    stylus_width : 12,
	    stylus_height : 20,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 10,
	    tick_width : 2,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 0,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
{
	    interactive : true,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider2",

	    left : 10,			// all in 'px' pixels
	    top : 10,
	    pane_image: "pane.gif",

	    scale_width : 50,
	    scale_height : 6,		
	    scale_image : "scale.gif",

	    stylus_width : 12,
	    stylus_height : 20,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 10,
	    tick_width : 2,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 1,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	},
{
	    interactive : true,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider3",

	    left : 10,			// all in 'px' pixels
	    top : 10,
	    pane_image: "pane.gif",

	    scale_width : 250,
	    scale_height : 6,		
	    scale_image : "scale.gif",

	    stylus_width : 12,
	    stylus_height : 20,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 10,
	    tick_width : 2,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 2,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider3",
	    form_id : "form1"			// in  the HTML page.
	},
{
	    interactive : true,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider4",

	    left : 10,			// all in 'px' pixels
	    top : 10,
	    pane_image: "pane.gif",

	    scale_width : 250,
	    scale_height : 6,		
	    scale_image : "scale.gif",

	    stylus_width : 12,
	    stylus_height : 20,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 10,
	    tick_width : 2,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 3,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider2",
	    form_id : "form1"			// in  the HTML page.
	},
{
	    interactive : true,		// User modifiable on 'true'
	    continuous : false,		// Any position allowed if 'true'
	    span_id : "slider5",

	    left : 10,			// all in 'px' pixels
	    top : 10,
	    pane_image: "pane.gif",

	    scale_width : 250,
	    scale_height : 6,		
	    scale_image : "scale.gif",

	    stylus_width : 12,
	    stylus_height : 20,
	    stylus_up   : "stylus.gif",
	    stylus_down : "stylus2.gif",

	    tick_height : 10,
	    tick_width : 2,
	    tick_image : "tick.gif",

	    ticks : 5,
	    start_tick : 4,
	    tick_tabs : null,		// auto-calc'ed if set to null

	    label_size : 10,		// in 'px' not in 'pt'
	    label_font : "\"Courier\"",
	    labels : ["","","","",""],
	    values : ["1","2","3","4","5"],

	    form_field_id : "slider1",
	    form_id : "form1"			// in  the HTML page.
	}
    ];

