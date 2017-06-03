<?php
    printHeader('Add Role');
?>

<div class="input-group">
    <form name="form" action="" method="get">
        <input type="hidden" name="action" id="action" value="addActor2db" />
        <div>
            <b>Role</b>
            <div>
                <label class="radio-inline">
                    <input type="radio" checked="checked" name="role" value="Actor"/>Actor
                </label>
                <label class="radio-inline">
                    <input type="radio" name="role" value="Director"/>Director
                </label>
            </div>
        </div>
        <div>
            <b>Name</b>
            <input type="text" class="form-control" placeholder="First name" name="first" />
            <input type="text" class="form-control" placeholder="Last name" name="last" />
        </div>
        <div>
            <b>Sex</b>
            <div>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="Male"/>Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="Female"/>Female
                </label>
            </div>
        </div>
        <div>
            <div class='input-group date'>
                <b>Date of Birth</b>
                <input name="birthdate" type='text' class="form-control" id="datepicker1" />
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datepicker1').datepicker({ dateFormat: 'yy-mm-dd' });
                });
            </script>
        </div>
        <div>
            <div class='input-group date'>
                <b>Date of Decease</b>
                <input name="deathdate" type='text' class="form-control" id="datepicker2" />
            </div>
            <script type="text/javascript">
                $(function () {
                    $('#datepicker2').datepicker({ dateFormat: 'yy-mm-dd' });
                });
            </script>
        </div>
        <div>
            <input type="submit" value="Add" class="btn btn-primary" />
        </div>
    </form>
</div>

<?php
    printFooter();
?>