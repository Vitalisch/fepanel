class Info extends AbstractEntity
{
    protected string $name = '';

    protected string $bodytext = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getBodytext(): string
    {
        return $this->bodytext;
    }

    public function setBodytext(string $bodytext): void
    {
        $this->bodytext = $bodytext;
    }
}