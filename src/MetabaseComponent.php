<?php

namespace Laravolt\Metabase;

use Illuminate\View\Component;

class MetabaseComponent extends Component
{
    public ?int $dashboard;

    public ?int $question;

    public ?int $exp;

    public bool $bordered;

    public bool $titled;

    public ?string $theme;

    /**
     * @var string[]
     */
    public ?array $params;

    /**
     * Create a new component instance.
     *
     * @param int|null $dashboard
     * @param int|null $question
     * @param int|null $exp
     * @param array<string> $params
     */
    public function __construct(?int $dashboard = null, ?int $question = null, ?int $exp = null, array $params = [], $bordered = false, $titled = false, $theme = null)
    {
        $this->dashboard = $dashboard;
        $this->question = $question;
        $this->exp = $exp;
        $this->params = $params;
        $this->bordered = $bordered;
        $this->titled = $titled;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $metabase = app(MetabaseService::class);
        $metabase->setParams($this->params);
        $metabase->setAdditionalParams($this->getAdditionalParams());
        $iframeUrl = $metabase->generateEmbedUrl((int) $this->dashboard, (int) $this->question, (int) $this->exp);
        return view('metabase::iframe', compact('iframeUrl'));
    }


    private function getAdditionalParams()
    {
        $additionalParameters['bordered'] = $this->bordered;
        $additionalParameters['titled'] = $this->titled;

        if($this->theme) {
            $additionalParameters['theme'] = $this->theme;
        }

        return $additionalParameters;
    }
}
