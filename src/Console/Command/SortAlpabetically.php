<?php


namespace MageGuide\AttributeOptionsSort\Console\Command;

use Magento\Framework\ObjectManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State;
use MageGuide\AttributeOptionsSort\Model\Sort\Alphabetically;

class SortAlpabetically extends Command
{
    const NAME_ARGUMENT = "Attribute";
    const NAME_OPTION = "option";

    /**
     * @var State
     */
    protected $_state;

    /**
     * @var Alphabetically
     */
    protected $_alphaSort;

    public function __construct(
        State $state,
        Alphabetically $alphabetically
    ) {
        $this->_state = $state;
        $this->_alphaSort = $alphabetically;
        parent::__construct(null);
    }


    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        try{
            $this->_state->setAreaCode('adminhtml');
            $name = $input->getArgument(self::NAME_ARGUMENT);
            $this->_alphaSort->sort($output,$name);
        }catch (\Exception $e){
            $output->writeln($e->getMessage());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("mageguide:sort:options");
        $this->setDescription("Sorts all attribute options alphabetically.");
        $this->setDefinition([
            new InputArgument(self::NAME_ARGUMENT, InputArgument::REQUIRED, "Attribute"),
            new InputOption(self::NAME_OPTION, "-o", InputOption::VALUE_NONE, "Option")
        ]);
        parent::configure();
    }
}
