<script type="text/javascript" charset="utf-8">
// ****************************** Extract Registered User List ************************************** 
// Called by tec_groups  
    var jQ15 = jQuery.noConflict();
    jQ15(document).ready(function () {
        var DTRequest = jQ15('#groupownerslist').DataTable({
        "processing": true,
        // "serverSide": true,
        "ajax": {
            url: 'includes/tec_get_group_owners.php',
            type: 'GET',
            },
        "order": [[ 1, 'asc' ]],
        "bAutoWidth": true,
        "searching": true,
        // "responsive": true,
        // "deferLoading": 0,
        "iDisplayLength": 10,
        // "pageLength": 0,
        "fixedHeader": {
            header: true,
            footer: false
        },
        columnDefs: [ 
            // {
                // className: 'dtr-control',
                // orderable: false,
                // targets:   [ 0 ]
            // },
			{
        		className: "owner_select",
        		"targets": [ 0 ] 
        	},
			{
        		className: "lastname",
        		"targets": [ 1 ] 
        	},
			{
        		className: "firstname",
        		"targets": [ 2 ] 
        	},
			{
    	   		className: "email",
                "visible": false,
				"targets": [ 3 ] 
	       	},
            {
    	   		className: "loginID_hidden",
				orderable: false,
				"targets": [ 4 ] 
	       	},
            {
    	   		className: "churchID",
                "visible": false,
				orderable: false,
				"targets": [ 5 ] 
	       	}
        ]
    });
    var DTRequest = jQ15('#groupmemberslist').DataTable({
        "processing": true,
        //"serverSide": true,
        "ajax": {
            url: 'includes/tec_get_group_members.php',
            type: 'GET',
            },
        "order": [[ 1, 'asc' ]],
        "bAutoWidth": true,
        "searching": true,
        // "responsive": true,
        // "deferLoading": 0,
        "iDisplayLength": 10,
        // "pageLength": 0,
        "fixedHeader": {
            header: true,
            footer: false
        },
        columnDefs: [ 
            // {
                // className: 'dtr-control',
                // orderable: false,
                // targets:   [ 0 ]
            // },
			{
        		className: "member_select",
        		"targets": [ 0 ] 
        	},
			{
        		className: "lastname",
        		"targets": [ 1 ] 
        	},
			{
        		className: "firstname",
        		"targets": [ 2 ] 
        	},
			{
    	   		className: "email",
                "visible": false,
				"targets": [ 3 ] 
	       	},
            {
    	   		className: "loginID_hidden",
				orderable: false,
				"targets": [ 4 ] 
	       	},
            {
    	   		className: "churchID",
                "visible": false,
				orderable: false,
				"targets": [ 5 ] 
	       	}
        ]
    });
});
</script>