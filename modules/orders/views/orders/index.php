<div class="row">
    <div class="col-lg-12 text-right">
        <?= $this->render('export/link'); ?>
    </div>
</div>
<div class="row" id="status_panel">
    <div class="col-lg-8">
        <?= $this->render(
            'statuses/status_panel',
            [
                'statuses' => $statuses
            ]
        ); ?>
    </div>
    <div class="col-lg-4">
        <?= $this->render(
            'search_panel',
            [
                'searchTypes' => $searchTypes
            ]
        ); ?>
    </div>

    <?= $this->render(
        'tables',
        [
            'paginationList' => $paginationList,
            'servicesList' => $servicesList,
            'modes' => $modes,
        ]
    ); ?>
</div>

<?= $this->render(
    'pagination_panel',
    [
        'pagination' => $paginationList['pagination']
    ]
); ?>
