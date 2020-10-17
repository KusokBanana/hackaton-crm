<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017002924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
                CREATE PROCEDURE update_transactions_totals() AS $$
                BEGIN
                    UPDATE transactions_totals totals
				    SET 
					    retail_cost         = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Розничные магазины'),
					    auto_cost           = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Автомобили и транспортные средства'),
					    phone_cost          = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Продажи по почте/телефону'),
					    utilities_cost      = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Коммунальные и кабельные услуги'),
					    nation_cost         = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Государственные услуги'),
					    personal_cost       = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Личные услуги'),
					    shops_cost          = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Магазины одежды'),
					    clothes_cost        = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Аренда автомобилей'),
					    rent_cost           = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Контрактные услуги'),
					    contract_cost       = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Транспортные услуги'),
					    transport_cost      = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Строительные магазины'),
					    building_cost       = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Профессиональные услуги'),
					    prof_cost           = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Бизнес услуги'),
					    business_cost       = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Членские взносы'),
					    fee_cost            = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Авиалинии, авиакомпании'),
					    air_cost            = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Оптовые поставщики и производители'),
					    vendors_cost        = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Отели и мотели'),
					    hotels_cost         = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Отели и мотели'),
					    entertainment_cost  = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Развлечения'),
					    finance_cost        = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name  = 'Финансовые услуги'),
					    other_cost          = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id and type_name IS NULL),
					    total_cost          = (select COALESCE(SUM(cost), 0) from transactions where client_id  = totals.client_id),
						--
						retail_count        = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Розничные магазины'),
						auto_count          = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Автомобили и транспортные средства'),
						phone_count         = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Продажи по почте/телефону'),
						utilities_count     = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Коммунальные и кабельные услуги'),
						nation_count        = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Государственные услуги'),
						personal_count      = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Личные услуги'),
						shops_count         = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Магазины одежды'),
						clothes_count       = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Аренда автомобилей'),
						rent_count          = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Контрактные услуги'),
						contract_count      = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Транспортные услуги'),
						transport_count     = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Строительные магазины'),
						building_count      = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Профессиональные услуги'),
						prod_count          = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Бизнес услуги'),
						business_count      = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Членские взносы'),
						fee_count           = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Авиалинии, авиакомпании'),
						air_count           = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Оптовые поставщики и производители'),
						vendors_count       = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Отели и мотели'),
						hotels_count        = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Отели и мотели'),
						entertainment_count = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Развлечения'),
						finance_count       = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name  = 'Финансовые услуги'),
						other_count         = (select COUNT(*) from transactions where client_id  = totals.client_id and type_name IS NULL),
						total_count         = (select COUNT(*) from transactions where client_id  = totals.client_id );
                END;
            $$ LANGUAGE plpgsql;
        ");

        $this->addSql('
            CREATE FUNCTION trigger_function_update_transactions_totals() RETURNS trigger AS $$
                BEGIN
                    CALL update_transactions_totals();
                    RETURN NULL;
                END;
            $$ LANGUAGE plpgsql;
        ');

        $this->addSql('
            CREATE TRIGGER trigger_update_transactions_totals
            AFTER
                INSERT OR
                UPDATE OF cost, type_name, type_id, client_id OR
                DELETE OR
                TRUNCATE
            ON transactions
            FOR EACH STATEMENT
            EXECUTE FUNCTION trigger_function_update_transactions_totals();
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER trigger_update_transactions_totals on transactions');
        $this->addSql('DROP FUNCTION trigger_function_update_transactions_totals');
        $this->addSql('DROP PROCEDURE update_transactions_totals');
    }
}
