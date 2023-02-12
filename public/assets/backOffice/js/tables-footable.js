
// Tables-FooTable.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -



$(window).on('load', function() {


    // FOO TABLES
    // =================================================================
    // Require FooTable
    // -----------------------------------------------------------------
    // http://fooplugins.com/footable-demos/
    // =================================================================


    // Row Toggler
    // -----------------------------------------------------------------
    $('#demo-foo-row-toggler').footable();




    // Expand / Collapse All Rows
    // -----------------------------------------------------------------
    var fooColExp = $('#demo-foo-row-toggler');
    //fooColExp.footable().trigger('footable_expand_first_row');


    $('#demo-foo-collapse').on('click', function(){
        fooColExp.trigger('footable_collapse_all');
    });
    $('#demo-foo-expand').on('click', function(){
        fooColExp.trigger('footable_expand_all');
    });




    // Add & Remove Row
    // -----------------------------------------------------------------
    var addrow = $('#demo-foo-row-toggler');
    addrow.footable();



    // Add Row Button
    $('#demo-btn-addrowm').click(function() {

        //get the footable object
        //var footable = addrow.data('footable');

        //build up the row we are wanting to add
        var newRow = '<tr><td><button class="demo-delete-row btn btn-danger btn-xs btn-icon fa fa-times"></button></td><td>Adam</td><td>Doe</td><td>Traffic Court Referee</td><td>22 Jun 1972</td><td><span class="label label-table label-success">Active</span></td><td>88</td><td>88</td><td>88</td><td>88</td><td>88</td><td>88</td><td>88</td><td>88</td></tr>';

        //add it
       // footable.appendRow(newRow);
        $('#new-element').after(newRow);
    });
});
