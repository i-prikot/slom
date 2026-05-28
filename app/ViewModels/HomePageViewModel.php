<?php

declare(strict_types=1);

namespace App\ViewModels;

use App\Support\PricingEstimator;

final class HomePageViewModel
{
    /**
     * @param  list<array{title: string, text: string, icon: string}>  $benefits
     * @param  list<array{image: string, title: string, text: string, primary: bool}>  $services
     * @param  list<string>  $serviceAreaCities
     * @param  list<array{image: string, title: string, task: string, term: string, result: string}>  $cases
     * @param  list<array{title: string, text: string, icon: string}>  $workSteps
     * @param  list<array{value: string, label: string}>  $trustStats
     * @param  list<array{title: string, icon: string}>  $trustDocuments
     * @param  list<array{logo: string, client: string}>  $trustClients
     * @param  list<array{image: string, title: string, subtitle: string}>  $certificates
     * @param  list<array{name: string, meta: string, date: string, text: string}>  $reviews
     * @param  list<array{photo: string, name: string, years: string, role: string, icon: string}>  $teamMembers
     * @param  list<array{question: string, answer: string}>  $faqs
     */
    public function __construct(
        public readonly array $benefits,
        public readonly array $services,
        public readonly array $serviceAreaCities,
        public readonly array $cases,
        public readonly array $workSteps,
        public readonly array $trustStats,
        public readonly array $trustDocuments,
        public readonly array $trustClients,
        public readonly array $certificates,
        public readonly array $reviews,
        public readonly array $teamMembers,
        public readonly array $faqs,
        public readonly array $cuttingPrices,
        public readonly array $drillingPrices,
        public readonly array $openingPrices,
        public readonly array $demolitionPrices,
        public readonly array $coefficientLabels,
    ) {
        if (
            $this->benefits === []
            || $this->services === []
            || $this->serviceAreaCities === []
            || $this->cases === []
            || $this->workSteps === []
            || $this->trustStats === []
            || $this->trustDocuments === []
            || $this->trustClients === []
            || $this->certificates === []
            || $this->reviews === []
            || $this->teamMembers === []
            || $this->faqs === []
        ) {
            throw new \RuntimeException('Home page sections are not configured.');
        }
    }

    public static function make(): self
    {
        return new self(
            benefits: [
                ['title' => 'Быстро понимаем задачу', 'text' => 'Уточняем детали по телефону и даём предварительную оценку.', 'icon' => 'phone-call'],
                ['title' => 'Точная цена без сюрпризов', 'text' => 'Озвучиваем стоимость до начала работ. Без скрытых доплат.', 'icon' => 'calculator'],
                ['title' => 'Аккуратно и безопасно', 'text' => 'Не повреждаем конструкции и не создаём трещин.', 'icon' => 'shield-check'],
                ['title' => 'Чистота на объекте', 'text' => 'Минимум пыли и воды. Убираем после себя и вывозим мусор.', 'icon' => 'sparkles'],
                ['title' => 'Работаем в срок', 'text' => 'Соблюдаем оговорённые сроки и не подводим клиентов.', 'icon' => 'clock'],
            ],
            services: [
                ['image' => 'case-opening.jpg', 'title' => 'Резка проёмов', 'text' => 'Двери, окна, арки в несущих и ненесущих стенах. Главная специализация.', 'primary' => true],
                ['image' => 'case-drilling.jpg', 'title' => 'Алмазное бурение', 'text' => 'Отверстия под вентиляцию, коммуникации, дымоходы, трубопроводы.', 'primary' => false],
                ['image' => 'case-demolition.jpg', 'title' => 'Демонтаж конструкций', 'text' => 'Демонтаж стен, перегородок, перекрытий, фундаментов без ударов и вибрации.', 'primary' => false],
                ['image' => 'service-reinforcement.jpg', 'title' => 'Усиление проёмов', 'text' => 'Усиление металлом по строительным нормам — официально и надёжно.', 'primary' => false],
            ],
            serviceAreaCities: ['Красноярск', 'Дивногорск', 'Сосновоборск', 'Берёзовка', 'Емельяново', 'Железногорск', 'Зеленогорск', 'Канск', 'Ачинск', 'Минусинск', 'Назарово'],
            cases: [
                ['image' => 'case-opening.jpg', 'title' => 'Проём в несущей стене', 'task' => 'Создать арочный проём в несущей стене квартиры.', 'term' => '1 день', 'result' => 'Ровный проём без трещин с усилением металлом.'],
                ['image' => 'case-drilling.jpg', 'title' => 'Бурение под вентиляцию', 'task' => 'Сделать сквозные отверстия 200 мм для вентканалов.', 'term' => '3 часа', 'result' => 'Точные отверстия без пыли в жилом помещении.'],
                ['image' => 'case-demolition.jpg', 'title' => 'Демонтаж перегородки', 'task' => 'Снести перегородку в офисе под перепланировку.', 'term' => '1 день', 'result' => 'Аккуратный демонтаж без повреждений соседних стен.'],
            ],
            workSteps: [
                ['title' => 'Вы звоните', 'text' => 'Или пишете в WhatsApp.', 'icon' => 'phone'],
                ['title' => 'Уточняем задачу', 'text' => 'Детали и условия объекта.', 'icon' => 'message-square'],
                ['title' => 'Выезд специалиста', 'text' => 'При необходимости — бесплатно.', 'icon' => 'truck'],
                ['title' => 'Фиксируем цену', 'text' => 'В договоре, без доплат.', 'icon' => 'file-text'],
                ['title' => 'Выполняем работу', 'text' => 'Аккуратно и в срок.', 'icon' => 'wrench'],
                ['title' => 'Сдаём чистый объект', 'text' => 'Убираем мусор за собой.', 'icon' => 'check-circle-2'],
            ],
            trustStats: [
                ['value' => '25 лет', 'label' => 'на рынке'],
                ['value' => '2000+', 'label' => 'успешных проектов'],
                ['value' => '100%', 'label' => 'положительных отзывов'],
            ],
            trustDocuments: [
                ['title' => 'СРО и допуски', 'icon' => 'award'],
                ['title' => 'Страховка ответственности', 'icon' => 'shield-check'],
                ['title' => 'Работаем по договору', 'icon' => 'file-check'],
            ],
            trustClients: [
                ['logo' => 'clients/planeta.jpg', 'client' => 'ТРЦ Планета'],
                ['logo' => 'clients/rosneft.jpg', 'client' => 'Роснефть · Ачинский НПЗ'],
                ['logo' => 'clients/sberbank.jpg', 'client' => 'Сбербанк России'],
                ['logo' => 'clients/opera.jpg', 'client' => 'Театр оперы и балета'],
                ['logo' => 'clients/kultbytstroy.jpg', 'client' => 'Культбытстрой'],
                ['logo' => 'clients/emelyanovo.jpg', 'client' => 'Аэропорт Емельяново'],
                ['logo' => 'clients/sibiryak.jpg', 'client' => 'Сибиряк'],
                ['logo' => 'clients/bellini.jpg', 'client' => 'Bellini Group'],
                ['logo' => 'clients/kraskom.jpg', 'client' => 'КрасКом'],
                ['logo' => 'clients/sgk.jpg', 'client' => 'Сибирская генерирующая компания'],
            ],
            certificates: [
                ['image' => 'certificates/sro-cover.jpg', 'title' => 'Свидетельство СРО', 'subtitle' => '№ С-248-2466270133-01'],
                ['image' => 'certificates/sro-1.jpg', 'title' => 'Приложение · стр. 1', 'subtitle' => 'Виды работ'],
                ['image' => 'certificates/sro-2.jpg', 'title' => 'Приложение · стр. 2', 'subtitle' => 'Подготовительные и земляные работы'],
                ['image' => 'certificates/sro-3.jpg', 'title' => 'Приложение · стр. 3', 'subtitle' => 'Наружные сети и газоснабжение'],
                ['image' => 'certificates/sro-4.jpg', 'title' => 'Приложение · стр. 4', 'subtitle' => 'Монтажные и пусконаладочные работы'],
                ['image' => 'certificates/sro-5.jpg', 'title' => 'Приложение · стр. 5', 'subtitle' => 'Дороги, мосты, гидротехника'],
                ['image' => 'certificates/sro-6.jpg', 'title' => 'Приложение · стр. 6', 'subtitle' => 'Строительный контроль'],
                ['image' => 'certificates/sro-7.jpg', 'title' => 'Приложение · стр. 7', 'subtitle' => 'Организация строительства'],
            ],
            reviews: [
                ['name' => 'Григорий С.', 'meta' => '25 отзывов · Знаток города 5 уровня', 'date' => '23 октября 2025', 'text' => 'Огромная благодарность! Приехал мужчина, всё подробно рассказал, проконсультировал, объяснил, на что обратить внимание. Очень вежливый, профессиональный и доброжелательный. Остались только положительные впечатления — видно, что человек знает своё дело. Рекомендую!'],
                ['name' => 'Сергей', 'meta' => 'Знаток города 2 уровня', 'date' => '12 июля 2024', 'text' => 'Большое спасибо Евгению за подробную консультацию с выездом на объект! Очень грамотный специалист, я обратился по поводу трещины во внутренней стене дома. Евгений очень подробно всё разъяснил по поводу причин возникновения и методов устранения. Я очень благодарен за высокий профессионализм и ответственное отношение к работе.'],
                ['name' => 'Светлана А.', 'meta' => '68 отзывов · Знаток города 12 уровня', 'date' => '6 декабря 2023', 'text' => 'В организацию обращалась неоднократно и с разными запросами: установка крыльца в нежилом помещении (прошло уже 10 лет — крыльцо как новое!), установка ж/б конструкции в лестничном проёме, ж/б конструкции для возведения балкона. Всё быстро, аккуратно, в срок. Работой осталась очень довольна!'],
                ['name' => 'Сергей Ф.', 'meta' => 'Знаток города 3 уровня', 'date' => '30 марта 2024', 'text' => 'Вырезали дверной проём в кирпичном доме, расширяли другие два проёма. На осмотр и сами работы приехали в назначенный день и время, после работ прибрали мусор. По выбору места проёма и его усиления дали чёткие рекомендации, виден профессионализм и инженерное мышление Евгения. Подобные работы нужно доверять только профессионалам с большим опытом.'],
            ],
            teamMembers: [
                ['photo' => 'team/1-evgeniy.png', 'name' => 'Евгений', 'years' => '20+ лет', 'role' => 'руководитель', 'icon' => 'award'],
                ['photo' => 'team/2-viktor.png', 'name' => 'Виктор', 'years' => '10+ лет', 'role' => 'помощник руководителя', 'icon' => 'hard-hat'],
                ['photo' => 'team/3-dmitriy.png', 'name' => 'Дмитрий', 'years' => '10+ лет', 'role' => 'старший мастер', 'icon' => 'hard-hat'],
                ['photo' => 'team/4-igor.png', 'name' => 'Игорь', 'years' => '10+ лет', 'role' => 'мастер алмазного бурения и резки', 'icon' => 'wrench'],
                ['photo' => 'team/5-aleksandr.png', 'name' => 'Александр', 'years' => '10+ лет', 'role' => 'мастер алмазного бурения и резки', 'icon' => 'wrench'],
                ['photo' => 'team/6-artem.png', 'name' => 'Артём', 'years' => '10+ лет', 'role' => 'мастер алмазного бурения и резки', 'icon' => 'wrench'],
                ['photo' => 'team/7-vladimir.png', 'name' => 'Владимир', 'years' => '10+ лет', 'role' => 'мастер бурения, резки и монтажно-сварочных работ', 'icon' => 'flame'],
                ['photo' => 'team/8-konstantin.png', 'name' => 'Константин', 'years' => '5 лет', 'role' => 'специалист по монтажно-сварочным работам', 'icon' => 'flame'],
                ['photo' => 'team/9-dmitriy.png', 'name' => 'Дмитрий', 'years' => '4 года', 'role' => 'мастер монтажно-сварочных работ', 'icon' => 'flame'],
            ],
            faqs: [
                ['question' => 'Сколько стоит алмазная резка?', 'answer' => 'Цена зависит от толщины бетона, объёма и сложности. Скажем стоимость по телефону за 2–3 минуты.'],
                ['question' => 'Можно ли срочно выполнить работу?', 'answer' => 'Да, часто выезжаем в день обращения. Позвоните — проверим возможность.'],
                ['question' => 'Вы работаете по договору?', 'answer' => 'Да, заключаем официальный договор и даём гарантию на выполненные работы.'],
                ['question' => 'Будет ли пыль и грязь?', 'answer' => 'Используем профессиональное оборудование с подачей воды. Пыли минимум, убираем после себя.'],
                ['question' => 'Работаете с несущими стенами?', 'answer' => 'Да, выполняем резку в несущих стенах с обязательным усилением проёмов и соблюдением всех норм.'],
                ['question' => 'Куда выезжаете?', 'answer' => 'Красноярск и все районы Красноярского края.'],
            ],
            cuttingPrices: PricingEstimator::CUTTING_PRICES,
            drillingPrices: PricingEstimator::DRILLING_PRICES,
            openingPrices: PricingEstimator::OPENING_PRICES,
            demolitionPrices: PricingEstimator::DEMOLITION_PRICES,
            coefficientLabels: PricingEstimator::COEFFICIENT_LABELS,
        );
    }
}
