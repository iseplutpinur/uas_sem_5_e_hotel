<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Menu</th>
                <th>All</th>
                <th>View</th>
                <th>Add</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if ($group)
                <tr>
                    <td>Dashboard</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_1" data-id="1">
                    </td>
                    <td>
                        <input class="check" data-menu="1" id="check_1_1" type="checkbox" name="dashboard_1" value="1" @if ($group->{'1_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="1" id="check_1_2" type="checkbox" name="dashboard_2" value="1" @if ($group->{'1_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="1" id="check_1_3" type="checkbox" name="dashboard_3" value="1" @if ($group->{'1_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="1" id="check_1_4" type="checkbox" name="dashboard_4" value="1" @if ($group->{'1_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Group User Admin</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_2" data-id="2">
                    </td>
                    <td>
                        <input class="check" data-menu="2" id="check_2_1" type="checkbox" name="groupuseradmin_1" value="1" @if ($group->{'2_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="2" id="check_2_2" type="checkbox" name="groupuseradmin_2" value="1" @if ($group->{'2_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="2" id="check_2_3" type="checkbox" name="groupuseradmin_3" value="1" @if ($group->{'2_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="2" id="check_2_4" type="checkbox" name="groupuseradmin_4" value="1" @if ($group->{'2_4'}) checked @endif>
                    </td>
                </tr>
            @else
                <tr>
                    <td colspan="6">No data found.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
