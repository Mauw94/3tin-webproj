<?php

namespace app;

use function DI\object;
use model\LocatiePDORepository;
use model\LocatieRepository;
use model\ProbleemMeldingPDORepository;
use model\ProbleemMeldingRepository;
use model\ScorePDORepository;
use model\ScoreRepository;
use model\StatusMeldingPDORepository;
use model\StatusMeldingRepository;
use view\JsonView;
use view\View;

return [
    LocatieRepository::class => object(LocatiePDORepository::class),
    ProbleemMeldingRepository::class => object(ProbleemMeldingPDORepository::class),
    StatusMeldingRepository::class => object(StatusMeldingPDORepository::class),
    ScoreRepository::class => object(ScorePDORepository::class),
    View::class => object(JsonView::class)
];