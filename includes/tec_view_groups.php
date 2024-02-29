<script type="text/javascript">
// ****************************** Show Groups Data **************************************
// Called by tec_groups.php
// Created 20220112 
var jQ8 = jQuery.noConflict();
jQ8(document).ready(function() {
    jQ8('#groupstable').DataTable({
//			"processing": true,
//			"serverSide": true,
        "ajax": {
            url: 'tec_getgroups.php',
            type: 'GET',
            },
//			"bJQueryUI": true,
//			"sScrollY": "600px",
//			"bPaginate": true,
//			"aaSorting": [[ 1, "asc" ]],
//			"ordering": true,
			"order": [[ 1, 'desc' ]],
//			"iDisplayLength": 100,
//			"bLengthChange": false,
//			"bFilter": true,
//			"bSort": true,
//			"bInfo": false,
            "bAutoWidth": true,
            // "responsive": true,
            "responsive": true,
            // "responsive": {
            // details: {
            //     type: 'column',
            //     target: 'tr'
            //     }
            // },
            // responsive: {
            //     details: {
            //         type: 'column'
            //     }
            // },
//			"sWrapper": "25px",
//			"orderClasses": false,
			"columnDefs": [ 
            {
                // className: 'dtr-control',
                orderable: false,
                targets:   [ 0 ]
            },
            {
        		className: "indexcol",
                targets:   [ 1 ]
            },
            {
        		className: "group_status",
                "visible": false,
                targets:   [ 2 ]
            },
			{
        		className: "group_created",
                "visible": false,
        		"targets": [ 3 ] 
        	},
			{
        		className: "group_name",
        		"targets": [ 4 ] 
        	},
			{
        		className: "group_owner",
                "visible": false,
        		"targets": [ 5 ] 
        	},
			{
        		className: "group_description",
        		"targets": [ 6 ] 
        	},
			{
        		className: "group_category",
                "visible": false,
        		"targets": [ 7 ] 
        	},
			{
        		className: "manage_column",
                orderable: false,
        		"targets": [ 8 ] 
        	},
			{
        		className: "email_column",
                orderable: false,
        		"targets": [ 9 ] 
        	}
        ]

    });
});
</script>

