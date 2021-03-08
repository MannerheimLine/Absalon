<div id="talon-header" style="width: 100%; text-align: center;">
    <h3 style="margin: auto">ТАЛОН АМБУЛАТОРНОГО ПАЦИЕНТА (Стоматолог)</h3>
</div>
<div id="talon-data">
    <div class="talon-line" style="margin-bottom: 5px;">
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td style="width: 45%">Код врача _________________</td>
                <td style="width: 45%; text-align: right;">Номер карты: <b><?=$formData['cardNumber']; ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="talon-line">
        1. Ф.И.О <b><?=$formData['fullName'];?></b>
        2. Пол: <b><?=$formData['genderDescription']; ?></b>
        3. Дата рождения: <b><?=$formData['dateBirth']; ?></b>
    </div>
    <div class="talon-line">
        4. Паспортные данные: <b><?=$formData['passportSerial'].' '.$formData['passportNumber']; ?></b>
        5. Выдан: <b><?=$formData['fmsDepartment'].' '.$formData['passportDateOfIssue'];?></b>
    </div>
    <div class="talon-line">
        6. Свидетельство о рождении: <b><?=$formData['birthCertificateSerial'].' '.$formData['birthCertificateNumber']; ?></b>
        7. Выдано: <b><?=$formData['registryOffice'].' '.$formData['birthCertificateDateOfIssue'];?></b>
    </div>
    <div class="talon-line">
        8. СНИЛС: <b><?=$formData['insuranceCertificate'];?></b>
        <?php if(isset($formData['policyNumber']) && !empty($formData['policyNumber'])) : ?>
        9. Полис: <b><?=$formData['policyNumber'];?></b>
        <?php else :?>
        9. Полис: <b><?=$formData['temporaryPolicyNumber'];?></b>
        <?php endif; ?>
    </div>
    <div class="talon-line">
        10. Страховая компания: <b><?=$formData['insuranceCompanyName'];?></b>
        11. Код страховщика: <b><?=$formData['insurerCode'];?></b>
    </div>
    <div class="talon-line">
        12. Категория: ___________
        13. Источник финансирования: ________
    </div>
    <div class="talon-line">
        14. Адрес: <b><?=$formData['address']; ?></b>
    </div>
    <?php if(isset($formData['workplace']) && !empty($formData['workplace'])) : ?>
        <div class="talon-line">
            <b>15. Работает</b>
            16. Место работы: <b><?=$formData['workplace']; ?></b>
            17. Профессия: <b><?=$formData['profession']; ?></b>
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
        <table class="talon-table" style="border-collapse: separate; border-spacing: 0px;">
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
                    <table style="border-collapse: separate; border-spacing: 0px;">
                        <tr style="text-align: center">
                            <td style="padding: 7px">П</td>
                        </tr>
                        <tr style="text-align: center">
                            <td style="padding: 7px">М</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table style="border-collapse: separate; border-spacing: 0px;">
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
