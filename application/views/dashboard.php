<!--
        <script>
    $(function () {
        show_fields();

        $('#user_type').change(function () {
            show_fields();
        });

        function show_fields() {
            $('#administrator_fields').hide();
            $('#guest_fields').hide();

            var user_type = $('#user_type').val();

            if (user_type === '1') {
                $('#administrator_fields').show();
            } else if (user_type === '2') {
                $('#guest_fields').show();
            }
        }

        $("#user_country").select2({
            placeholder: "Country",
            allowClear: true
        });

        $('#add-user-client-modal').click(function () {
                        $('#modal-placeholder').load("users/ajax/modal_add_user_client/1");
        });
    });
</script>

<form method="post">

    <input type="hidden" name="_ip_csrf" value="b62790f066d781b090f45b86f4c54e7e">

    <div id="headerbar">
        <h1 class="headerbar-title">User Form</h1>
        <div class="headerbar-item pull-right">
    <div class="btn-group btn-group-sm">
                    <button id="btn-submit" name="btn_submit" class="btn btn-success ajax-loader" value="1">
                <i class="fa fa-check"></i> Save            </button>
                            <button id="btn-cancel" name="btn_cancel" class="btn btn-danger" value="1">
                <i class="fa fa-times"></i> Cancel            </button>
            </div>
</div>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3">

                




                <div id="userInfo">

                    <div class="panel panel-default">
                        <div class="panel-heading">Account Information</div>

                        <div class="panel-body">
                            <div class="form-group">
                                <label for="user_name">
                                    Name                                </label>
                                <input type="text" name="user_name" id="user_name" class="form-control"
                                       value="InvoicePlane Demo">
                            </div>

                            <div class="form-group">
                                <label for="user_company">
                                    Company                                </label>
                                <input type="text" name="user_company" id="user_company" class="form-control"
                                       value="">
                            </div>

                            <div class="form-group">
                                <label for="user_email">
                                    Email Address                                </label>
                                <input type="text" name="user_email" id="user_email" class="form-control"
                                       value="demo@invoiceplane.com">
                            </div>

                                                            <div class="form-group">
                                    <a href="users/change_password/1"
                                       class="btn btn-default">
                                        Change Password                                    </a>
                                </div>
                            
                            <div class="form-group">
                                <label for="user_language">
                                    Language                                </label>
                                <select name="user_language" id="user_language" class="form-control simple-select">
                                    <option value="system">
                                        Use System language                                    </option>
                                                                            <option value="english"
                                            >
                                            English                                        </option>
                                                                    </select>
                            </div>

                            <div class="form-group">
                                <label for="user_type">
                                    User Type                                </label>
                                <select name="user_type" id="user_type" class="form-control simple-select">
                                                                            <option value="1"
                                            selected="selected">
                                            Administrator                                        </option>
                                                                            <option value="2"
                                            >
                                            Guest (Read Only)                                        </option>
                                                                    </select>
                            </div>
                        </div>

                    </div>

                    <div id="administrator_fields">
                        <div class="panel panel-default">
                            <div class="panel-heading">Address</div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="user_address_1">
                                        Street Address                                    </label>
                                    <input type="text" name="user_address_1" id="user_address_1" class="form-control"
                                           value="285 Fulton St.">
                                </div>

                                <div class="form-group">
                                    <label for="user_address_2">
                                        Street Address 2                                    </label>
                                    <input type="text" name="user_address_2" id="user_address_2" class="form-control"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <label for="user_city">
                                        City                                    </label>
                                    <input type="text" name="user_city" id="user_city" class="form-control"
                                           value="New York">
                                </div>

                                <div class="form-group">
                                    <label for="user_state">
                                        State                                    </label>
                                    <input type="text" name="user_state" id="user_state" class="form-control"
                                           value="NY">
                                </div>

                                <div class="form-group">
                                    <label for="user_zip">
                                        Zip Code                                    </label>
                                    <input type="text" name="user_zip" id="user_zip" class="form-control"
                                           value="10007">
                                </div>

                                <div class="form-group">
                                    <label for="user_country">
                                        Country                                    </label>
                                    <select name="user_country" id="user_country" class="form-control">
                                        <option value="">None</option>
                                                                                    <option value="AF"
                                                >
                                                Afghanistan                                            </option>
                                                                                    <option value="AL"
                                                >
                                                Albania                                            </option>
                                                                                    <option value="DZ"
                                                >
                                                Algeria                                            </option>
                                                                                    <option value="AS"
                                                >
                                                American Samoa                                            </option>
                                                                                    <option value="AD"
                                                >
                                                Andorra                                            </option>
                                                                                    <option value="AO"
                                                >
                                                Angola                                            </option>
                                                                                    <option value="AI"
                                                >
                                                Anguilla                                            </option>
                                                                                    <option value="AQ"
                                                >
                                                Antarctica                                            </option>
                                                                                    <option value="AG"
                                                >
                                                Antigua and Barbuda                                            </option>
                                                                                    <option value="AR"
                                                >
                                                Argentina                                            </option>
                                                                                    <option value="AM"
                                                >
                                                Armenia                                            </option>
                                                                                    <option value="AW"
                                                >
                                                Aruba                                            </option>
                                                                                    <option value="AU"
                                                >
                                                Australia                                            </option>
                                                                                    <option value="AT"
                                                >
                                                Austria                                            </option>
                                                                                    <option value="AZ"
                                                >
                                                Azerbaijan                                            </option>
                                                                                    <option value="BS"
                                                >
                                                Bahamas                                            </option>
                                                                                    <option value="BH"
                                                >
                                                Bahrain                                            </option>
                                                                                    <option value="BD"
                                                >
                                                Bangladesh                                            </option>
                                                                                    <option value="BB"
                                                >
                                                Barbados                                            </option>
                                                                                    <option value="BY"
                                                >
                                                Belarus                                            </option>
                                                                                    <option value="BE"
                                                >
                                                Belgium                                            </option>
                                                                                    <option value="BZ"
                                                >
                                                Belize                                            </option>
                                                                                    <option value="BJ"
                                                >
                                                Benin                                            </option>
                                                                                    <option value="BM"
                                                >
                                                Bermuda                                            </option>
                                                                                    <option value="BT"
                                                >
                                                Bhutan                                            </option>
                                                                                    <option value="BO"
                                                >
                                                Bolivia                                            </option>
                                                                                    <option value="BA"
                                                >
                                                Bosnia and Herzegovina                                            </option>
                                                                                    <option value="BW"
                                                >
                                                Botswana                                            </option>
                                                                                    <option value="BV"
                                                >
                                                Bouvet Island                                            </option>
                                                                                    <option value="BR"
                                                >
                                                Brazil                                            </option>
                                                                                    <option value="BQ"
                                                >
                                                British Antarctic Territory                                            </option>
                                                                                    <option value="IO"
                                                >
                                                British Indian Ocean Territory                                            </option>
                                                                                    <option value="VG"
                                                >
                                                British Virgin Islands                                            </option>
                                                                                    <option value="BN"
                                                >
                                                Brunei                                            </option>
                                                                                    <option value="BG"
                                                >
                                                Bulgaria                                            </option>
                                                                                    <option value="BF"
                                                >
                                                Burkina Faso                                            </option>
                                                                                    <option value="BI"
                                                >
                                                Burundi                                            </option>
                                                                                    <option value="KH"
                                                >
                                                Cambodia                                            </option>
                                                                                    <option value="CM"
                                                >
                                                Cameroon                                            </option>
                                                                                    <option value="CA"
                                                >
                                                Canada                                            </option>
                                                                                    <option value="CT"
                                                >
                                                Canton and Enderbury Islands                                            </option>
                                                                                    <option value="CV"
                                                >
                                                Cape Verde                                            </option>
                                                                                    <option value="KY"
                                                >
                                                Cayman Islands                                            </option>
                                                                                    <option value="CF"
                                                >
                                                Central African Republic                                            </option>
                                                                                    <option value="TD"
                                                >
                                                Chad                                            </option>
                                                                                    <option value="CL"
                                                >
                                                Chile                                            </option>
                                                                                    <option value="CN"
                                                >
                                                China                                            </option>
                                                                                    <option value="CX"
                                                >
                                                Christmas Island                                            </option>
                                                                                    <option value="CC"
                                                >
                                                Cocos [Keeling] Islands                                            </option>
                                                                                    <option value="CO"
                                                >
                                                Colombia                                            </option>
                                                                                    <option value="KM"
                                                >
                                                Comoros                                            </option>
                                                                                    <option value="CG"
                                                >
                                                Congo - Brazzaville                                            </option>
                                                                                    <option value="CD"
                                                >
                                                Congo - Kinshasa                                            </option>
                                                                                    <option value="CK"
                                                >
                                                Cook Islands                                            </option>
                                                                                    <option value="CR"
                                                >
                                                Costa Rica                                            </option>
                                                                                    <option value="HR"
                                                >
                                                Croatia                                            </option>
                                                                                    <option value="CU"
                                                >
                                                Cuba                                            </option>
                                                                                    <option value="CY"
                                                >
                                                Cyprus                                            </option>
                                                                                    <option value="CZ"
                                                >
                                                Czech Republic                                            </option>
                                                                                    <option value="CI"
                                                >
                                                Côte d’Ivoire                                            </option>
                                                                                    <option value="DK"
                                                >
                                                Denmark                                            </option>
                                                                                    <option value="DJ"
                                                >
                                                Djibouti                                            </option>
                                                                                    <option value="DM"
                                                >
                                                Dominica                                            </option>
                                                                                    <option value="DO"
                                                >
                                                Dominican Republic                                            </option>
                                                                                    <option value="NQ"
                                                >
                                                Dronning Maud Land                                            </option>
                                                                                    <option value="EC"
                                                >
                                                Ecuador                                            </option>
                                                                                    <option value="EG"
                                                >
                                                Egypt                                            </option>
                                                                                    <option value="SV"
                                                >
                                                El Salvador                                            </option>
                                                                                    <option value="GQ"
                                                >
                                                Equatorial Guinea                                            </option>
                                                                                    <option value="ER"
                                                >
                                                Eritrea                                            </option>
                                                                                    <option value="EE"
                                                >
                                                Estonia                                            </option>
                                                                                    <option value="ET"
                                                >
                                                Ethiopia                                            </option>
                                                                                    <option value="FK"
                                                >
                                                Falkland Islands                                            </option>
                                                                                    <option value="FO"
                                                >
                                                Faroe Islands                                            </option>
                                                                                    <option value="FJ"
                                                >
                                                Fiji                                            </option>
                                                                                    <option value="FI"
                                                >
                                                Finland                                            </option>
                                                                                    <option value="FR"
                                                >
                                                France                                            </option>
                                                                                    <option value="GF"
                                                >
                                                French Guiana                                            </option>
                                                                                    <option value="PF"
                                                >
                                                French Polynesia                                            </option>
                                                                                    <option value="TF"
                                                >
                                                French Southern Territories                                            </option>
                                                                                    <option value="FQ"
                                                >
                                                French Southern and Antarctic Territories                                            </option>
                                                                                    <option value="GA"
                                                >
                                                Gabon                                            </option>
                                                                                    <option value="GM"
                                                >
                                                Gambia                                            </option>
                                                                                    <option value="GE"
                                                >
                                                Georgia                                            </option>
                                                                                    <option value="DE"
                                                >
                                                Germany                                            </option>
                                                                                    <option value="GH"
                                                >
                                                Ghana                                            </option>
                                                                                    <option value="GI"
                                                >
                                                Gibraltar                                            </option>
                                                                                    <option value="GR"
                                                >
                                                Greece                                            </option>
                                                                                    <option value="GL"
                                                >
                                                Greenland                                            </option>
                                                                                    <option value="GD"
                                                >
                                                Grenada                                            </option>
                                                                                    <option value="GP"
                                                >
                                                Guadeloupe                                            </option>
                                                                                    <option value="GU"
                                                >
                                                Guam                                            </option>
                                                                                    <option value="GT"
                                                >
                                                Guatemala                                            </option>
                                                                                    <option value="GG"
                                                >
                                                Guernsey                                            </option>
                                                                                    <option value="GN"
                                                >
                                                Guinea                                            </option>
                                                                                    <option value="GW"
                                                >
                                                Guinea-Bissau                                            </option>
                                                                                    <option value="GY"
                                                >
                                                Guyana                                            </option>
                                                                                    <option value="HT"
                                                >
                                                Haiti                                            </option>
                                                                                    <option value="HM"
                                                >
                                                Heard Island and McDonald Islands                                            </option>
                                                                                    <option value="HN"
                                                >
                                                Honduras                                            </option>
                                                                                    <option value="HK"
                                                >
                                                Hong Kong SAR China                                            </option>
                                                                                    <option value="HU"
                                                >
                                                Hungary                                            </option>
                                                                                    <option value="IS"
                                                >
                                                Iceland                                            </option>
                                                                                    <option value="IN"
                                                >
                                                India                                            </option>
                                                                                    <option value="ID"
                                                >
                                                Indonesia                                            </option>
                                                                                    <option value="IR"
                                                >
                                                Iran                                            </option>
                                                                                    <option value="IQ"
                                                >
                                                Iraq                                            </option>
                                                                                    <option value="IE"
                                                >
                                                Ireland                                            </option>
                                                                                    <option value="IM"
                                                >
                                                Isle of Man                                            </option>
                                                                                    <option value="IL"
                                                >
                                                Israel                                            </option>
                                                                                    <option value="IT"
                                                >
                                                Italy                                            </option>
                                                                                    <option value="JM"
                                                >
                                                Jamaica                                            </option>
                                                                                    <option value="JP"
                                                >
                                                Japan                                            </option>
                                                                                    <option value="JE"
                                                >
                                                Jersey                                            </option>
                                                                                    <option value="JT"
                                                >
                                                Johnston Island                                            </option>
                                                                                    <option value="JO"
                                                >
                                                Jordan                                            </option>
                                                                                    <option value="KZ"
                                                >
                                                Kazakhstan                                            </option>
                                                                                    <option value="KE"
                                                >
                                                Kenya                                            </option>
                                                                                    <option value="KI"
                                                >
                                                Kiribati                                            </option>
                                                                                    <option value="KW"
                                                >
                                                Kuwait                                            </option>
                                                                                    <option value="KG"
                                                >
                                                Kyrgyzstan                                            </option>
                                                                                    <option value="LA"
                                                >
                                                Laos                                            </option>
                                                                                    <option value="LV"
                                                >
                                                Latvia                                            </option>
                                                                                    <option value="LB"
                                                >
                                                Lebanon                                            </option>
                                                                                    <option value="LS"
                                                >
                                                Lesotho                                            </option>
                                                                                    <option value="LR"
                                                >
                                                Liberia                                            </option>
                                                                                    <option value="LY"
                                                >
                                                Libya                                            </option>
                                                                                    <option value="LI"
                                                >
                                                Liechtenstein                                            </option>
                                                                                    <option value="LT"
                                                >
                                                Lithuania                                            </option>
                                                                                    <option value="LU"
                                                >
                                                Luxembourg                                            </option>
                                                                                    <option value="MO"
                                                >
                                                Macau SAR China                                            </option>
                                                                                    <option value="MK"
                                                >
                                                Macedonia                                            </option>
                                                                                    <option value="MG"
                                                >
                                                Madagascar                                            </option>
                                                                                    <option value="MW"
                                                >
                                                Malawi                                            </option>
                                                                                    <option value="MY"
                                                >
                                                Malaysia                                            </option>
                                                                                    <option value="MV"
                                                >
                                                Maldives                                            </option>
                                                                                    <option value="ML"
                                                >
                                                Mali                                            </option>
                                                                                    <option value="MT"
                                                >
                                                Malta                                            </option>
                                                                                    <option value="MH"
                                                >
                                                Marshall Islands                                            </option>
                                                                                    <option value="MQ"
                                                >
                                                Martinique                                            </option>
                                                                                    <option value="MR"
                                                >
                                                Mauritania                                            </option>
                                                                                    <option value="MU"
                                                >
                                                Mauritius                                            </option>
                                                                                    <option value="YT"
                                                >
                                                Mayotte                                            </option>
                                                                                    <option value="FX"
                                                >
                                                Metropolitan France                                            </option>
                                                                                    <option value="MX"
                                                >
                                                Mexico                                            </option>
                                                                                    <option value="FM"
                                                >
                                                Micronesia                                            </option>
                                                                                    <option value="MI"
                                                >
                                                Midway Islands                                            </option>
                                                                                    <option value="MD"
                                                >
                                                Moldova                                            </option>
                                                                                    <option value="MC"
                                                >
                                                Monaco                                            </option>
                                                                                    <option value="MN"
                                                >
                                                Mongolia                                            </option>
                                                                                    <option value="ME"
                                                >
                                                Montenegro                                            </option>
                                                                                    <option value="MS"
                                                >
                                                Montserrat                                            </option>
                                                                                    <option value="MA"
                                                >
                                                Morocco                                            </option>
                                                                                    <option value="MZ"
                                                >
                                                Mozambique                                            </option>
                                                                                    <option value="MM"
                                                >
                                                Myanmar [Burma]                                            </option>
                                                                                    <option value="NA"
                                                >
                                                Namibia                                            </option>
                                                                                    <option value="NR"
                                                >
                                                Nauru                                            </option>
                                                                                    <option value="NP"
                                                >
                                                Nepal                                            </option>
                                                                                    <option value="NL"
                                                >
                                                The Netherlands                                            </option>
                                                                                    <option value="AN"
                                                >
                                                Netherlands Antilles                                            </option>
                                                                                    <option value="NT"
                                                >
                                                Neutral Zone                                            </option>
                                                                                    <option value="NC"
                                                >
                                                New Caledonia                                            </option>
                                                                                    <option value="NZ"
                                                >
                                                New Zealand                                            </option>
                                                                                    <option value="NI"
                                                >
                                                Nicaragua                                            </option>
                                                                                    <option value="NE"
                                                >
                                                Niger                                            </option>
                                                                                    <option value="NG"
                                                >
                                                Nigeria                                            </option>
                                                                                    <option value="NU"
                                                >
                                                Niue                                            </option>
                                                                                    <option value="NF"
                                                >
                                                Norfolk Island                                            </option>
                                                                                    <option value="KP"
                                                >
                                                North Korea                                            </option>
                                                                                    <option value="VD"
                                                >
                                                North Vietnam                                            </option>
                                                                                    <option value="MP"
                                                >
                                                Northern Mariana Islands                                            </option>
                                                                                    <option value="NO"
                                                >
                                                Norway                                            </option>
                                                                                    <option value="OM"
                                                >
                                                Oman                                            </option>
                                                                                    <option value="PC"
                                                >
                                                Pacific Islands Trust Territory                                            </option>
                                                                                    <option value="PK"
                                                >
                                                Pakistan                                            </option>
                                                                                    <option value="PW"
                                                >
                                                Palau                                            </option>
                                                                                    <option value="PS"
                                                >
                                                Palestinian Territories                                            </option>
                                                                                    <option value="PA"
                                                >
                                                Panama                                            </option>
                                                                                    <option value="PZ"
                                                >
                                                Panama Canal Zone                                            </option>
                                                                                    <option value="PG"
                                                >
                                                Papua New Guinea                                            </option>
                                                                                    <option value="PY"
                                                >
                                                Paraguay                                            </option>
                                                                                    <option value="YD"
                                                >
                                                People's Democratic Republic of Yemen                                            </option>
                                                                                    <option value="PE"
                                                >
                                                Peru                                            </option>
                                                                                    <option value="PH"
                                                >
                                                Philippines                                            </option>
                                                                                    <option value="PN"
                                                >
                                                Pitcairn Islands                                            </option>
                                                                                    <option value="PL"
                                                >
                                                Poland                                            </option>
                                                                                    <option value="PT"
                                                >
                                                Portugal                                            </option>
                                                                                    <option value="PR"
                                                >
                                                Puerto Rico                                            </option>
                                                                                    <option value="QA"
                                                >
                                                Qatar                                            </option>
                                                                                    <option value="RO"
                                                >
                                                Romania                                            </option>
                                                                                    <option value="RU"
                                                >
                                                Russia                                            </option>
                                                                                    <option value="RW"
                                                >
                                                Rwanda                                            </option>
                                                                                    <option value="RE"
                                                >
                                                Réunion                                            </option>
                                                                                    <option value="BL"
                                                >
                                                Saint Barthélemy                                            </option>
                                                                                    <option value="SH"
                                                >
                                                Saint Helena                                            </option>
                                                                                    <option value="KN"
                                                >
                                                Saint Kitts and Nevis                                            </option>
                                                                                    <option value="LC"
                                                >
                                                Saint Lucia                                            </option>
                                                                                    <option value="MF"
                                                >
                                                Saint Martin                                            </option>
                                                                                    <option value="PM"
                                                >
                                                Saint Pierre and Miquelon                                            </option>
                                                                                    <option value="VC"
                                                >
                                                Saint Vincent and the Grenadines                                            </option>
                                                                                    <option value="WS"
                                                >
                                                Samoa                                            </option>
                                                                                    <option value="SM"
                                                >
                                                San Marino                                            </option>
                                                                                    <option value="SA"
                                                >
                                                Saudi Arabia                                            </option>
                                                                                    <option value="SN"
                                                >
                                                Senegal                                            </option>
                                                                                    <option value="RS"
                                                >
                                                Serbia                                            </option>
                                                                                    <option value="CS"
                                                >
                                                Serbia and Montenegro                                            </option>
                                                                                    <option value="SC"
                                                >
                                                Seychelles                                            </option>
                                                                                    <option value="SL"
                                                >
                                                Sierra Leone                                            </option>
                                                                                    <option value="SG"
                                                >
                                                Singapore                                            </option>
                                                                                    <option value="SK"
                                                >
                                                Slovakia                                            </option>
                                                                                    <option value="SI"
                                                >
                                                Slovenia                                            </option>
                                                                                    <option value="SB"
                                                >
                                                Solomon Islands                                            </option>
                                                                                    <option value="SO"
                                                >
                                                Somalia                                            </option>
                                                                                    <option value="ZA"
                                                >
                                                South Africa                                            </option>
                                                                                    <option value="GS"
                                                >
                                                South Georgia and the South Sandwich Islands                                            </option>
                                                                                    <option value="KR"
                                                >
                                                South Korea                                            </option>
                                                                                    <option value="ES"
                                                >
                                                Spain                                            </option>
                                                                                    <option value="LK"
                                                >
                                                Sri Lanka                                            </option>
                                                                                    <option value="SD"
                                                >
                                                Sudan                                            </option>
                                                                                    <option value="SR"
                                                >
                                                Suriname                                            </option>
                                                                                    <option value="SJ"
                                                >
                                                Svalbard and Jan Mayen                                            </option>
                                                                                    <option value="SZ"
                                                >
                                                Swaziland                                            </option>
                                                                                    <option value="SE"
                                                >
                                                Sweden                                            </option>
                                                                                    <option value="CH"
                                                >
                                                Switzerland                                            </option>
                                                                                    <option value="SY"
                                                >
                                                Syria                                            </option>
                                                                                    <option value="ST"
                                                >
                                                São Tomé and Príncipe                                            </option>
                                                                                    <option value="TW"
                                                >
                                                Taiwan                                            </option>
                                                                                    <option value="TJ"
                                                >
                                                Tajikistan                                            </option>
                                                                                    <option value="TZ"
                                                >
                                                Tanzania                                            </option>
                                                                                    <option value="TH"
                                                >
                                                Thailand                                            </option>
                                                                                    <option value="TL"
                                                >
                                                Timor-Leste                                            </option>
                                                                                    <option value="TG"
                                                >
                                                Togo                                            </option>
                                                                                    <option value="TK"
                                                >
                                                Tokelau                                            </option>
                                                                                    <option value="TO"
                                                >
                                                Tonga                                            </option>
                                                                                    <option value="TT"
                                                >
                                                Trinidad and Tobago                                            </option>
                                                                                    <option value="TN"
                                                >
                                                Tunisia                                            </option>
                                                                                    <option value="TR"
                                                >
                                                Turkey                                            </option>
                                                                                    <option value="TM"
                                                >
                                                Turkmenistan                                            </option>
                                                                                    <option value="TC"
                                                >
                                                Turks and Caicos Islands                                            </option>
                                                                                    <option value="TV"
                                                >
                                                Tuvalu                                            </option>
                                                                                    <option value="UM"
                                                >
                                                U.S. Minor Outlying Islands                                            </option>
                                                                                    <option value="PU"
                                                >
                                                U.S. Miscellaneous Pacific Islands                                            </option>
                                                                                    <option value="VI"
                                                >
                                                U.S. Virgin Islands                                            </option>
                                                                                    <option value="UG"
                                                >
                                                Uganda                                            </option>
                                                                                    <option value="UA"
                                                >
                                                Ukraine                                            </option>
                                                                                    <option value="SU"
                                                >
                                                Union of Soviet Socialist Republics                                            </option>
                                                                                    <option value="AE"
                                                >
                                                United Arab Emirates                                            </option>
                                                                                    <option value="GB"
                                                >
                                                United Kingdom                                            </option>
                                                                                    <option value="US"
                                                selected="selected">
                                                United States                                            </option>
                                                                                    <option value="ZZ"
                                                >
                                                Unknown or Invalid Region                                            </option>
                                                                                    <option value="UY"
                                                >
                                                Uruguay                                            </option>
                                                                                    <option value="UZ"
                                                >
                                                Uzbekistan                                            </option>
                                                                                    <option value="VU"
                                                >
                                                Vanuatu                                            </option>
                                                                                    <option value="VA"
                                                >
                                                Vatican City                                            </option>
                                                                                    <option value="VE"
                                                >
                                                Venezuela                                            </option>
                                                                                    <option value="VN"
                                                >
                                                Vietnam                                            </option>
                                                                                    <option value="WK"
                                                >
                                                Wake Island                                            </option>
                                                                                    <option value="WF"
                                                >
                                                Wallis and Futuna                                            </option>
                                                                                    <option value="EH"
                                                >
                                                Western Sahara                                            </option>
                                                                                    <option value="YE"
                                                >
                                                Yemen                                            </option>
                                                                                    <option value="ZM"
                                                >
                                                Zambia                                            </option>
                                                                                    <option value="ZW"
                                                >
                                                Zimbabwe                                            </option>
                                                                                    <option value="AX"
                                                >
                                                Åland Islands                                            </option>
                                                                            </select>
                                </div>

                                 Custom fields 
                                                                                                </div>

                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Taxes Information</div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="user_vat_id">
                                        VAT ID                                    </label>
                                    <input type="text" name="user_vat_id" id="user_vat_id" class="form-control"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <label for="user_tax_code">
                                        Taxes Code                                    </label>
                                    <input type="text" name="user_tax_code" id="user_tax_code" class="form-control"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <label for="user_iban">
                                        IBAN                                    </label>
                                    <input type="text" name="user_iban" id="user_iban" class="form-control"
                                           value="">
                                </div>

                                <div class="form-group">
                                    <label for="user_subscribernumber">
                                        Subscriber Number                                    </label>
                                    <input type="text" name="user_subscribernumber" id="user_subscribernumber"
                                           class="form-control"
                                           value="">
                                </div>

                                 Custom fields 
                                                                                                </div>

                        </div>

                        
                        <div class="panel panel-default">

                            <div class="panel-heading">Contact Information</div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="user_phone">
                                        Phone Number                                    </label>
                                    <input type="text" name="user_phone" id="user_phone" class="form-control"
                                           value="123-555-0100">
                                </div>

                                <div class="form-group">
                                    <label for="user_fax">
                                        Fax Number                                    </label>
                                    <input type="text" name="user_fax" id="user_fax" class="form-control"
                                           value="123-555-0199">
                                </div>

                                <div class="form-group">
                                    <label for="user_mobile">
                                        Mobile Number                                    </label>
                                    <input type="text" name="user_mobile" id="user_mobile" class="form-control"
                                           value="123-555-0200">
                                </div>

                                <div class="form-group">
                                    <label for="user_web">
                                        Web Address                                    </label>
                                    <input type="text" name="user_web" id="user_web" class="form-control"
                                           value="https://invoiceplane.com">
                                </div>

                                 Custom fields 
                                                                                                </div>

                        </div>
                                                    <div class="panel panel-default">
                                <div class="panel-heading">Custom Fields</div>

                                <div class="panel-body">
                                                                    </div>

                            </div>
                        
                    </div>

                </div>

            </div>
        </div>
    </div>

</form>
   -->
   
   <div class="row ">
        <div class="col-xs-12">

            <div id="panel-quick-actions" class="panel panel-default quick-actions">

                <div class="panel-heading">
                    <b>Quick Actionssss</b>
                </div>

                <div class="btn-group btn-group-justified no-margin">
                    <a href="clients/form" class="btn btn-default">
                        <i class="fa fa-user fa-margin"></i>
                        <span class="hidden-xs">Add Client</span>
                    </a>
                    <a href="javascript:void(0)" class="create-quote btn btn-default">
                        <i class="fa fa-file fa-margin"></i>
                        <span class="hidden-xs">Create Quote</span>
                    </a>
                    <a href="javascript:void(0)" class="create-invoice btn btn-default">
                        <i class="fa fa-file-text fa-margin"></i>
                        <span class="hidden-xs">Create Invoice</span>
                    </a>
                    <a href="payments/form" class="btn btn-default">
                        <i class="fa fa-credit-card fa-margin"></i>
                        <span class="hidden-xs">Enter Payment</span>
                    </a>
                </div>

            </div>
        </div>
    </div>
   
   <div class="row">
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-quotes" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> Recent Quotes</b>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th style="min-width: 15%;">Date</th>
                            <th style="min-width: 15%;">Quote</th>
                            <th style="min-width: 35%;">Client</th>
                            <th style="text-align: right;">Balance</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                                                    <tr>
                                <td>
                                <span class="label
                                sent">
                                    Sent                                </span>
                                </td>
                                <td>
                                    04/10/2017                                </td>
                                <td>
                                    <a href="quotes/view/14">QUO-17-0014</a>                                </td>
                                <td>
                                    <a href="clients/view/5">Flint Motors, Ltd.</a>                                </td>
                                <td class="amount">
                                    $1,498.56                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/14" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                viewed">
                                    Viewed                                </span>
                                </td>
                                <td>
                                    04/06/2017                                </td>
                                <td>
                                    <a href="quotes/view/13">QUO-17-0013</a>                                </td>
                                <td>
                                    <a href="clients/view/6">Julia Steward</a>                                </td>
                                <td class="amount">
                                    $31,018.00                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/13" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    03/15/2017                                </td>
                                <td>
                                    <a href="quotes/view/12">QUO-17-0012</a>                                </td>
                                <td>
                                    <a href="clients/view/3">El Ninos Pizza</a>                                </td>
                                <td class="amount">
                                    $33,070.00                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/12" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    01/17/2017                                </td>
                                <td>
                                    <a href="quotes/view/11">QUO-17-0011</a>                                </td>
                                <td>
                                    <a href="clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $458,303.74                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/11" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    01/09/2017                                </td>
                                <td>
                                    <a href="quotes/view/10">QUO-17-0010</a>                                </td>
                                <td>
                                    <a href="clients/view/10">Merrick Roads, Ltd.</a>                                </td>
                                <td class="amount">
                                    $187.20                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/10" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    12/19/2016                                </td>
                                <td>
                                    <a href="quotes/view/9">QUO-17-0009</a>                                </td>
                                <td>
                                    <a href="clients/view/9">Waltermart Supplies</a>                                </td>
                                <td class="amount">
                                    $8,280.00                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/9" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    12/08/2016                                </td>
                                <td>
                                    <a href="quotes/view/8">QUO-17-0008</a>                                </td>
                                <td>
                                    <a href="clients/view/1">Morris Haulin'</a>                                </td>
                                <td class="amount">
                                    $119,340.70                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/8" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    11/10/2016                                </td>
                                <td>
                                    <a href="quotes/view/7">QUO-17-0007</a>                                </td>
                                <td>
                                    <a href="clients/view/7">Jasveer Arwehan</a>                                </td>
                                <td class="amount">
                                    $491.13                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/7" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                approved">
                                    Approved                                </span>
                                </td>
                                <td>
                                    11/09/2016                                </td>
                                <td>
                                    <a href="quotes/view/6">QUO-17-0006</a>                                </td>
                                <td>
                                    <a href="clients/view/13">Lorraine Gibson</a>                                </td>
                                <td class="amount">
                                    $31,525.00                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/6" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                    <tr>
                                <td>
                                <span class="label
                                canceled">
                                    Canceled                                </span>
                                </td>
                                <td>
                                    11/02/2016                                </td>
                                <td>
                                    <a href="quotes/view/5">QUO-17-0005</a>                                </td>
                                <td>
                                    <a href="clients/view/13">Lorraine Gibson</a>                                </td>
                                <td class="amount">
                                    $37,440.75                                </td>
                                <td style="text-align: center;">
                                    <a href="quotes/generate_pdf/5" title="Download PDF" target="_blank">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                                                <tr>
                            <td colspan="6" class="text-right small">
                                <a href="quotes/status/all">View All</a>                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-invoices" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> Recent Invoices</b>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th style="min-width: 15%;">Due Date</th>
                            <th style="min-width: 15%;">Invoice</th>
                            <th style="min-width: 35%;">Client</th>
                            <th style="text-align: right;">Balance</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                                                    <tr>
                                <td>
                                    <span class="label sent">
                                        Sent                                    </span>
                                </td>
                                <td>
                                    <span class="font-overdue">
                                        05/24/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/18">INV-17-0018</a>                                </td>
                                <td>
                                    <a href="clients/view/12">Alvin Lewis</a>                                </td>
                                <td class="amount">
                                    $31.50                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/18" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        05/05/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/16">INV-17-0016</a>                                </td>
                                <td>
                                    <a href="clients/view/11">Hempstead Pizza One</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/16" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        05/20/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/15">INV-17-0015</a>                                </td>
                                <td>
                                    <a href="clients/view/12">Alvin Lewis</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/15" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        05/03/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/14">INV-17-0014</a>                                </td>
                                <td>
                                    <a href="clients/view/3">El Ninos Pizza</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/14" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label viewed">
                                        Viewed                                    </span>
                                </td>
                                <td>
                                    <span class="font-overdue">
                                        04/30/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/13">INV-17-0013</a>                                </td>
                                <td>
                                    <a href="clients/view/3">El Ninos Pizza</a>                                </td>
                                <td class="amount">
                                    $33,070.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/13" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        04/14/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/12">INV-17-0012</a>                                </td>
                                <td>
                                    <a href="clients/view/11">Hempstead Pizza One</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/12" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        04/07/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/11">INV-17-0011</a>                                </td>
                                <td>
                                    <a href="clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/11" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        03/04/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/10">INV-17-0010</a>                                </td>
                                <td>
                                    <a href="clients/view/4">Waterford Reparis Inc.</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/10" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        02/15/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/9">INV-17-0009</a>                                </td>
                                <td>
                                    <a href="clients/view/2">Stockton Cabs</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/9" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                    <tr>
                                <td>
                                    <span class="label paid">
                                        Paid                                            &nbsp;<i class="fa fa-read-only" title="Read only"></i>
                                                                            </span>
                                </td>
                                <td>
                                    <span class="">
                                        02/12/2017                                    </span>
                                </td>
                                <td>
                                    <a href="invoices/view/8">INV-17-0008</a>                                </td>
                                <td>
                                    <a href="clients/view/1">Morris Haulin'</a>                                </td>
                                <td class="amount">
                                    $0.00                                </td>
                                <td style="text-align: center;">
                                                                            <a href="invoices/generate_pdf/8" title="Download PDF" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                                                    </td>
                            </tr>
                                                <tr>
                            <td colspan="6" class="text-right small">
                                <a href="invoices/status/all">View All</a>                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>