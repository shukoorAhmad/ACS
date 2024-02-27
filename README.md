DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=icc_auth
DB_USERNAME=root
DB_PASSWORD=

DB_CONNECTION_lookup=mysql
DB_HOST_lookup=127.0.0.1
DB_PORT_lookup=3306
DB_DATABASE_lookup=lookup_db
DB_USERNAME_lookup=root
DB_PASSWORD_lookup=

DB_CONNECTION_weapon_sys=mysql
DB_HOST_weapon_sys=127.0.0.1
DB_PORT_weapon_sys=3306
DB_DATABASE_weapon_sys=weapon_sys_db
DB_USERNAME_weapon_sys=root
DB_PASSWORD_weapon_sys=

DB_CONNECTION_armor_vehicle=mysql
DB_HOST_armor_vehicle=127.0.0.1
DB_PORT_armor_vehicle=3306
DB_DATABASE_armor_vehicle=armor_vehicle_db
DB_USERNAME_armor_vehicle=root
DB_PASSWORD_armor_vehicle=

DB_CONNECTION_security_company=mysql
DB_HOST_security_company=127.0.0.1
DB_PORT_security_company=3306
DB_DATABASE_security_company=security_company_db
DB_USERNAME_security_company=root
DB_PASSWORD_security_company=

vendors/spatie/laravel activity log / src/ models/ activity.php

add the below function at the end

protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
}
