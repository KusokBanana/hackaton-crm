<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201017002925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
                CREATE PROCEDURE update_predictions_sum() AS $$
                BEGIN
                    UPDATE predictions
				    SET sum_chance = mortgage_chance + consumer_credit_chance + credit_card_chance;
                END;
            $$ LANGUAGE plpgsql;
        ");

        $this->addSql('
            CREATE FUNCTION trigger_function_update_predictions_sum() RETURNS trigger AS $$
                BEGIN
                    CALL update_predictions_sum();
                    RETURN NULL;
                END;
            $$ LANGUAGE plpgsql;
        ');

        $this->addSql('
            CREATE TRIGGER trigger_update_predictions_sum
            AFTER
                INSERT OR
                UPDATE OF mortgage_chance, consumer_credit_chance, credit_card_chance
            ON predictions
            FOR EACH STATEMENT
            EXECUTE FUNCTION trigger_function_update_predictions_sum();
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TRIGGER trigger_update_predictions_sum on predictions');
        $this->addSql('DROP FUNCTION trigger_function_update_predictions_sum');
        $this->addSql('DROP PROCEDURE update_predictions_sum');
    }
}
