<div id="talon-header" style="width: 100%; text-align: center;">
    <h3 style="margin: auto">ТАЛОН АМБУЛАТОРНОГО ПАЦИЕНТА (Стоматолог)</h3>
</div>
<div id="talon-data">
    <div class="talon-line" style="margin-bottom: 5px;">
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td style="width: 45%">Код врача _________________</td>
                <td style="width: 45%; text-align: right;">Номер карты: <b><?=$talonData['cardNumber']; ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="talon-line">
        1. Ф.И.О <b><?=$talonData['fullName'];?></b>
        2. Пол: <b><?=$talonData['genderDescription']; ?></b>
        3. Дата рождения: <b><?=$talonData['dateBirth']; ?></b>
    </div>
    <div class="talon-line">
        4. Паспортные данные: <b><?=$talonData['passportSerial'].' '.$talonData['passportNumber']; ?></b>
        5. Выдан: <b><?=$talonData['fmsDepartment']?></b>
    </div>
    <div class="talon-line">
        6. Свидетельство о рождении: <b><?=$talonData['birthCertificateSerial'].' '.$talonData['birthCertificateNumber']; ?></b>
        7. Выдано: <b><?=$talonData['registryOffice'];?></b>
    </div>
    <div class="talon-line">
        8. СНИЛС: <b><?=$talonData['insuranceCertificate'];?></b>
        9. Полис: <b><?=$talonData['policyNumber'];?></b>
    </div>
    <div class="talon-line">
        10. Страховая компания: <b><?=$talonData['insuranceCompanyName'];?></b>
        11. Код страховщика: <b><?=$talonData['insurerCode'];?></b>
    </div>
    <div class="talon-line">
        12. Категория: ___________
        13. Источник финансирования: ________
    </div>
    <div class="talon-line">
        14. Адрес: <b><?=$talonData['address']; ?></b>
    </div>
    <?php if(isset($talonData['workplace']) && !empty($talonData['workplace'])) : ?>
        <div class="talon-line">
            <b>15. Работает</b>
            16. Место работы: <b><?=$talonData['workplace']; ?></b>
            17. Профессия: <b><?=$talonData['profession']; ?></b>
        </div>
    <?php else :?>
        <div class="talon-line">
            <b>15. Не работает</b>
            16. Место работы: <b>отсутствует</b>
            17. Статус: <b><i>Пенсионер</i> / <i>Безработный</i></b>
        </div>
    <?php endif; ?>
    <div class="talon-line">
        18. Категория льготы: _____
        19. Цель обслуживания: ______________________________
    </div>
    <div class="talon-line">
        20. С острой болью: 1 - да, 2 - нет
        21. Первичный: 1 - да, 2 - нет
        22. Характер течения: ___________
    </div>
    <div class="talon-line">
        23. Пломбы всего: ___________________ в т.ч. цемент ___________________ композит _________________
    </div>
    <div class="talon-line">
        24. Анестезия:  Аппл ___________________ Инфильтр ___________________ Проводн ___________________
    </div>

    <div class="talon-line">
        25. Диагноз основной уточненный:
        <table class="talon-table">
            <thead>
            <tr>
                <th style="width: 25%;">Код МЭС</th>
                <th style="width: 10%;">УЕТ</th>
                <th style="width: 5%;"></th>
                <th style="width: 10%;">№ Зуба</th>
                <th style="width: 10%;">Код операции</th>
                <th style="width: 10%;">Дата посещения</th>
                <th style="width: 10%;">Тип посещения</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <td style="height: 20px"></td>
                <td></td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr style="text-align: center">
                            <td style="padding: 7px">П</td>
                        </tr>
                        <tr style="text-align: center">
                            <td style="padding: 7px">М</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                <tr>
                <td style="height: 20px"></td>
                <td></td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr style="text-align: center">
                            <td style="padding: 7px">П</td>
                        </tr>
                        <tr style="text-align: center">
                            <td style="padding: 7px">М</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                <tr>
                <td style="height: 20px"></td>
                <td></td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr style="text-align: center">
                            <td style="padding: 7px">П</td>
                        </tr>
                        <tr style="text-align: center">
                            <td style="padding: 7px">М</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
                <tr>
                <td style="height: 20px"></td>
                <td></td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr style="text-align: center">
                            <td style="padding: 7px">П</td>
                        </tr>
                        <tr style="text-align: center">
                            <td style="padding: 7px">М</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                        <tr>
                            <td style="width: 30px; height: 30px;"> </td>
                            <td style="width: 30px; height: 30px;"> </td>
                        </tr>
                    </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="talon-line" style="margin-top: 10px;">
        26. Больничный лист:  Выдан _______________________________ Закрыт ________________________________
    </div>
    <div class="talon-line">
        27. Справка:  Выдана ___________________________________ Закрыта ___________________________________
    </div>
    <div class="talon-line">
        29. Госпитализирован: _______________________________ № направления _____________________________
    </div>
    <div class="talon-line">
        29. Исход лечения: код __________________________
        30. Законченный случай: 1 - да, 2 - нет
    </div>
    <div class="talon-line">
        31. Родители: _________________________________________________________________________________________
    </div>
    <div class="talon-line">
        32. Адрес (для инокраевых) ________________________________________________________________________
    </div>
    <div class="talon-line">
        33. Документ (для инокраевых) _____________________________________________________________________
    </div>
    <div class="talon-line">
        34. Страховщик (для инокраевых) _________________________________________________________________
    </div>
</div>
<div id="talon-footer">
    <div class="talon-line" style="margin-top: 15px;">
        ФИО врача __________________________________ Подпись ________________________
    </div>
</div>
