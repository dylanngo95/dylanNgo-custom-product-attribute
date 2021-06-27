<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Console\Command;

use DylanNgo\CustomProductAttribute\Api\Data\IngredientInterfaceFactory;
use DylanNgo\CustomProductAttribute\Model\IngredientsRepository;
use Exception;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Csv;
use Magento\Framework\Setup\SampleData\FixtureManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;


/**
 * Class ImportIngredients
 * @package DylanNgo\CustomProductAttribute\Console\Command
 */
class ImportIngredients extends Command
{
    private IngredientsRepository $ingredientsRepository;

    private IngredientInterfaceFactory $ingredientInterfaceFactory;

    private Csv $csvReader;

    private FixtureManager $fixtureManager;

    /**
     * ImportIngredients constructor.
     *
     * @param IngredientsRepository $ingredientsRepository
     * @param IngredientInterfaceFactory $ingredientInterfaceFactory
     * @param SampleDataContext $context
     */
    public function __construct(
        IngredientsRepository $ingredientsRepository,
        IngredientInterfaceFactory $ingredientInterfaceFactory,
        SampleDataContext $context
    )
    {
        parent::__construct();
        $this->ingredientsRepository = $ingredientsRepository;
        $this->ingredientInterfaceFactory = $ingredientInterfaceFactory;
        $this->csvReader = $context->getCsvReader();
        $this->fixtureManager = $context->getFixtureManager();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('import:ingredients');
        $this->setDescription('Import Ingredients');
        parent::configure();
    }

    /**
     * CLI command description
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     * @throws LocalizedException
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $path = "DylanNgo_CustomProductAttribute::fixtures/ingredients.csv";
        $fileName = $this->fixtureManager->getFixture($path);
        if (!file_exists($fileName)) {
            return;
        }

        $rows = $this->csvReader->getData($fileName);
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = [];
            foreach ($row as $key => $value) {
                $data[$header[$key]] = $value;
            }
            $ingredients = $this->ingredientInterfaceFactory->create();
            $ingredients->setValue((string) $data['value']);
            $ingredients->setPosition((int) $data['position']);
            $this->ingredientsRepository->save($ingredients);
        }
        $output->writeln("Ingredient import was completed.");
    }
}
