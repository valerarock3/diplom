-- Очистка таблицы
TRUNCATE TABLE product;

-- Гитары
INSERT INTO product (name, price, category, description, image) VALUES
('Fender Stratocaster Standard', 89999, 'guitars', 'Классическая электрогитара с тремя звукоснимателями', 'strat_black.jpg'),
('Gibson Les Paul Traditional', 159999, 'guitars', 'Легендарная электрогитара с хамбакерами', 'gibson_lp.jpg'),
('Yamaha F310', 15999, 'guitars', 'Акустическая гитара для начинающих', 'yamaha_f310.jpg'),
('Ibanez RG550', 79999, 'guitars', 'Электрогитара для скоростной игры', 'ibanez_rg.jpg'),
('Martin D-28', 199999, 'guitars', 'Премиальная акустическая гитара', 'martin_d28.jpg'),
('Taylor 214ce', 89999, 'guitars', 'Электроакустическая гитара с вырезом', 'taylor_214ce.jpg'),
('Gretsch G2420T', 69999, 'guitars', 'Полуакустическая гитара с Bigsby', 'gretsch_g2420t.jpg'),
('PRS SE Custom 24', 84999, 'guitars', 'Электрогитара с кленовым топом', 'prs_custom.jpg'),
('Epiphone Les Paul Standard', 45999, 'guitars', 'Доступная версия легендарного Les Paul', 'epiphone_lp.jpg'),
('Jackson Soloist', 74999, 'guitars', 'Гитара для метала', 'jackson_soloist.jpg'),
('Seagull S6', 39999, 'guitars', 'Акустическая гитара канадского производства', 'seagull_s6.jpg'),
('ESP LTD EC-1000', 89999, 'guitars', 'Электрогитара премиум-класса', 'esp_ec1000.jpg'),
('Washburn WD10S', 19999, 'guitars', 'Акустическая гитара начального уровня', 'washburn_wd10s.jpg'),
('Schecter C-1', 64999, 'guitars', 'Электрогитара для тяжелой музыки', 'schecter_c1.jpg'),
('Guild D-55', 149999, 'guitars', 'Премиальная акустическая гитара', 'guild_d55.jpg');

-- Струны
INSERT INTO product (name, price, category, description, image) VALUES
('Ernie Ball Regular Slinky', 799, 'strings', 'Струны 10-46 для электрогитары', 'strings_regular.jpg'),
('D'Addario EXL110', 699, 'strings', 'Никелированные струны 10-46', 'daddario_exl110.jpg'),
('Martin SP Acoustic', 1299, 'strings', 'Струны для акустической гитары', 'martin_sp.jpg'),
('Elixir Nanoweb Electric', 1499, 'strings', 'Струны с покрытием для электрогитары', 'elixir_nanoweb.jpg'),
('GHS Boomers', 599, 'strings', 'Струны для электрогитары', 'ghs_boomers.jpg'),
('DR Pure Blues', 899, 'strings', 'Струны для блюза', 'dr_blues.jpg'),
('Dunlop Heavy Core', 749, 'strings', 'Струны для тяжелого рока', 'dunlop_heavy.jpg'),
('Cleartone Bronze', 1399, 'strings', 'Струны для акустической гитары', 'cleartone_bronze.jpg'),
('Rotosound Swing Bass', 1199, 'strings', 'Струны для бас-гитары', 'rotosound_bass.jpg'),
('Dean Markley Blue Steel', 899, 'strings', 'Криогенически обработанные струны', 'markley_blue.jpg'),
('Gibson Vintage Reissue', 1299, 'strings', 'Реплика винтажных струн', 'gibson_vintage.jpg'),
('Fender Super Bullets', 699, 'strings', 'Струны с пулевидными концами', 'fender_bullets.jpg'),
('Augustine Classical', 999, 'strings', 'Струны для классической гитары', 'augustine_classic.jpg'),
('D'Addario NYXL', 1199, 'strings', 'Усиленные струны для электрогитары', 'daddario_nyxl.jpg'),
('Elixir Phosphor Bronze', 1599, 'strings', 'Струны для акустической гитары с покрытием', 'elixir_phosphor.jpg');

-- Аксессуары
INSERT INTO product (name, price, category, description, image) VALUES
('Dunlop Jazz III', 99, 'accessories', 'Медиатор для точной игры', 'picks_jazz.jpg'),
('Planet Waves Capo', 1299, 'accessories', 'Каподастр для гитары', 'capo.jpg'),
('Ernie Ball Volume Pedal', 6999, 'accessories', 'Педаль громкости', 'volume_pedal.jpg'),
('D'Addario Guitar Strap', 1499, 'accessories', 'Ремень для гитары', 'daddario_strap.jpg'),
('Hercules Guitar Stand', 2999, 'accessories', 'Стойка для гитары', 'hercules_stand.jpg'),
('Dunlop System 65', 799, 'accessories', 'Набор для ухода за гитарой', 'dunlop_care.jpg'),
('Planet Waves Tuner', 1999, 'accessories', 'Тюнер для гитары', 'pw_tuner.jpg'),
('Kyser String Cleaner', 499, 'accessories', 'Очиститель струн', 'string_cleaner.jpg'),
('Levy's Leather Strap', 2499, 'accessories', 'Кожаный ремень', 'levys_strap.jpg'),
('Dunlop Trigger Capo', 1799, 'accessories', 'Быстросъемный каподастр', 'trigger_capo.jpg'),
('Ernie Ball Polish', 599, 'accessories', 'Полироль для гитары', 'polish.jpg'),
('Planet Waves Cable', 1299, 'accessories', 'Гитарный кабель', 'pw_cable.jpg'),
('Fender Picks Set', 399, 'accessories', 'Набор медиаторов', 'fender_picks.jpg'),
('D'Addario Humidifier', 899, 'accessories', 'Увлажнитель для гитары', 'humidifier.jpg'),
('Guitar Tool Kit', 2999, 'accessories', 'Набор инструментов для обслуживания', 'tool_kit.jpg');

-- Чехлы и кейсы
INSERT INTO product (name, price, category, description, image) VALUES
('Gator Hard Case', 12999, 'cases', 'Жесткий кейс для электрогитары', 'gator_case.jpg'),
('Fender Gig Bag', 4999, 'cases', 'Мягкий чехол для электрогитары', 'fender_case.jpg'),
('SKB Acoustic Case', 15999, 'cases', 'Кейс для акустической гитары', 'skb_acoustic.jpg'),
('Levy's Padded Bag', 3999, 'cases', 'Утепленный чехол', 'levys_bag.jpg'),
('Mono M80', 19999, 'cases', 'Премиальный чехол', 'mono_m80.jpg'),
('Road Runner Case', 8999, 'cases', 'Кейс для путешествий', 'roadrunner.jpg'),
('Gator Pro Go', 16999, 'cases', 'Серия профессиональных чехлов', 'gator_pro.jpg'),
('Reunion Blues Bag', 14999, 'cases', 'Кожаный чехол', 'reunion_blues.jpg'),
('SKB Waterproof', 24999, 'cases', 'Водонепроницаемый кейс', 'skb_water.jpg'),
('Fender Deluxe Case', 9999, 'cases', 'Твердый кейс Deluxe', 'fender_deluxe.jpg'),
('Gator Economy', 6999, 'cases', 'Экономичный кейс', 'gator_eco.jpg'),
('Mono Dual Case', 29999, 'cases', 'Чехол для двух гитар', 'mono_dual.jpg'),
('SKB Molded Case', 18999, 'cases', 'Формованный кейс', 'skb_molded.jpg'),
('Levy's Premium Case', 21999, 'cases', 'Премиум кейс', 'levys_premium.jpg'),
('Road Runner Double', 13999, 'cases', 'Двойной чехол', 'roadrunner_double.jpg');

-- Педали эффектов
INSERT INTO product (name, price, category, description, image) VALUES
('Boss DS-1', 5999, 'pedals', 'Педаль дисторшн', 'boss_ds1.jpg'),
('MXR Phase 90', 7999, 'pedals', 'Педаль фейзер', 'mxr_phase90.jpg'),
('Ibanez Tube Screamer', 8999, 'pedals', 'Овердрайв педаль', 'tube_screamer.jpg'),
('EHX Big Muff', 9999, 'pedals', 'Педаль фузз', 'big_muff.jpg'),
('Boss DD-7', 11999, 'pedals', 'Цифровая педаль задержки', 'boss_dd7.jpg'),
('TC Electronic Hall of Fame', 12999, 'pedals', 'Педаль реверберации', 'tc_hof.jpg'),
('Dunlop Cry Baby', 8999, 'pedals', 'Педаль вау-вау', 'cry_baby.jpg'),
('Boss CH-1', 7999, 'pedals', 'Педаль хорус', 'boss_ch1.jpg'),
('MXR Carbon Copy', 13999, 'pedals', 'Аналоговая задержка', 'carbon_copy.jpg'),
('EHX POG2', 24999, 'pedals', 'Полифонический октавер', 'pog2.jpg'),
('Strymon Timeline', 34999, 'pedals', 'Многофункциональная педаль задержки', 'timeline.jpg'),
('Boss RC-3', 14999, 'pedals', 'Педаль лупер', 'boss_rc3.jpg'),
('TC Electronic Ditto', 9999, 'pedals', 'Компактный лупер', 'ditto.jpg'),
('Walrus Audio Julia', 16999, 'pedals', 'Хорус/вибрато', 'julia.jpg'),
('JHS Morning Glory', 19999, 'pedals', 'Педаль овердрайв', 'morning_glory.jpg');

-- Усилители
INSERT INTO product (name, price, category, description, image) VALUES
('Fender Blues Junior', 54999, 'amplifiers', 'Ламповый комбоусилитель 15 Вт', 'blues_junior.jpg'),
('Marshall DSL40', 64999, 'amplifiers', 'Ламповый комбоусилитель 40 Вт', 'marshall_dsl40.jpg'),
('Vox AC15', 59999, 'amplifiers', 'Винтажный стиль, 15 Вт', 'vox_ac15.jpg'),
('Mesa Boogie Dual Rectifier', 149999, 'amplifiers', 'Усилитель для метала', 'dual_rec.jpg'),
('Roland Jazz Chorus', 74999, 'amplifiers', 'Легендарный чистый звук', 'jazz_chorus.jpg'),
('Orange Tiny Terror', 44999, 'amplifiers', 'Компактный ламповый усилитель', 'tiny_terror.jpg'),
('Blackstar HT Club 40', 69999, 'amplifiers', 'Универсальный комбик', 'blackstar_ht40.jpg'),
('EVH 5150 III', 129999, 'amplifiers', 'Усилитель Эдди Ван Халена', 'evh_5150.jpg'),
('Kemper Profiler', 199999, 'amplifiers', 'Цифровой профилирующий усилитель', 'kemper.jpg'),
('Fender Twin Reverb', 109999, 'amplifiers', 'Классический чистый звук', 'twin_reverb.jpg'),
('Marshall JCM800', 119999, 'amplifiers', 'Легендарный рок-усилитель', 'jcm800.jpg'),
('Mesa Boogie Mark V', 189999, 'amplifiers', 'Топовый усилитель', 'mark5.jpg'),
('Vox AC30', 89999, 'amplifiers', 'Британский звук', 'vox_ac30.jpg'),
('Orange Rockerverb', 139999, 'amplifiers', 'Мощный усилитель', 'rockerverb.jpg'),
('Line 6 Helix', 159999, 'amplifiers', 'Цифровой процессор', 'helix.jpg'); 