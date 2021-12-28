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
                <tr>
                    <td>User Admin</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_3" data-id="3">
                    </td>
                    <td>
                        <input class="check" data-menu="3" id="check_3_1" type="checkbox" name="useradmin_1" value="1" @if ($group->{'3_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="3" id="check_3_2" type="checkbox" name="useradmin_2" value="1" @if ($group->{'3_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="3" id="check_3_3" type="checkbox" name="useradmin_3" value="1" @if ($group->{'3_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="3" id="check_3_4" type="checkbox" name="useradmin_4" value="1" @if ($group->{'3_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Authorization Setting</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_4" data-id="4">
                    </td>
                    <td>
                        <input class="check" data-menu="4" id="check_4_1" type="checkbox" name="authorizationsetting_1" value="1" @if ($group->{'4_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="4" id="check_4_2" type="checkbox" name="authorizationsetting_2" value="1" @if ($group->{'4_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="4" id="check_4_3" type="checkbox" name="authorizationsetting_3" value="1" @if ($group->{'4_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="4" id="check_4_4" type="checkbox" name="authorizationsetting_4" value="1" @if ($group->{'4_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Banner</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_5" data-id="5">
                    </td>
                    <td>
                        <input class="check" data-menu="5" id="check_5_1" type="checkbox" name="banner_1" value="1" @if ($group->{'5_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="5" id="check_5_2" type="checkbox" name="banner_2" value="1" @if ($group->{'5_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="5" id="check_5_3" type="checkbox" name="banner_3" value="1" @if ($group->{'5_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="5" id="check_5_4" type="checkbox" name="banner_4" value="1" @if ($group->{'5_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Room Category</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_6" data-id="6">
                    </td>
                    <td>
                        <input class="check" data-menu="6" id="check_6_1" type="checkbox" name="roomcategory_1" value="1" @if ($group->{'6_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="6" id="check_6_2" type="checkbox" name="roomcategory_2" value="1" @if ($group->{'6_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="6" id="check_6_3" type="checkbox" name="roomcategory_3" value="1" @if ($group->{'6_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="6" id="check_6_4" type="checkbox" name="roomcategory_4" value="1" @if ($group->{'6_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Room</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_7" data-id="7">
                    </td>
                    <td>
                        <input class="check" data-menu="7" id="check_7_1" type="checkbox" name="room_1" value="1" @if ($group->{'7_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="7" id="check_7_2" type="checkbox" name="room_2" value="1" @if ($group->{'7_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="7" id="check_7_3" type="checkbox" name="room_3" value="1" @if ($group->{'7_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="7" id="check_7_4" type="checkbox" name="room_4" value="1" @if ($group->{'7_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Facility</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_8" data-id="8">
                    </td>
                    <td>
                        <input class="check" data-menu="8" id="check_8_1" type="checkbox" name="facility_1" value="1" @if ($group->{'8_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="8" id="check_8_2" type="checkbox" name="facility_2" value="1" @if ($group->{'8_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="8" id="check_8_3" type="checkbox" name="facility_3" value="1" @if ($group->{'8_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="8" id="check_8_4" type="checkbox" name="facility_4" value="1" @if ($group->{'8_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Payment Method</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_9" data-id="9">
                    </td>
                    <td>
                        <input class="check" data-menu="9" id="check_9_1" type="checkbox" name="paymentmethod_1" value="1" @if ($group->{'9_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="9" id="check_9_2" type="checkbox" name="paymentmethod_2" value="1" @if ($group->{'9_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="9" id="check_9_3" type="checkbox" name="paymentmethod_3" value="1" @if ($group->{'9_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="9" id="check_9_4" type="checkbox" name="paymentmethod_4" value="1" @if ($group->{'9_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Transaction</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_10" data-id="10">
                    </td>
                    <td>
                        <input class="check" data-menu="10" id="check_10_1" type="checkbox" name="transaction_1" value="1" @if ($group->{'10_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="10" id="check_10_2" type="checkbox" name="transaction_2" value="1" @if ($group->{'10_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="10" id="check_10_3" type="checkbox" name="transaction_3" value="1" @if ($group->{'10_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="10" id="check_10_4" type="checkbox" name="transaction_4" value="1" @if ($group->{'10_4'}) checked @endif>
                    </td>
                </tr>
                <tr>
                    <td>Rating</td>
                    <td>
                        <input type="checkbox" class="check-all" id="check_11" data-id="11">
                    </td>
                    <td>
                        <input class="check" data-menu="11" id="check_11_1" type="checkbox" name="rating_1" value="1" @if ($group->{'11_1'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="11" id="check_11_2" type="checkbox" name="rating_2" value="1" @if ($group->{'11_2'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="11" id="check_11_3" type="checkbox" name="rating_3" value="1" @if ($group->{'11_3'}) checked @endif>
                    </td>
                    <td>
                        <input class="check" data-menu="11" id="check_11_4" type="checkbox" name="rating_4" value="1" @if ($group->{'11_4'}) checked @endif>
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
