<div id="card-header">
    <h3>МЕДИЦИНСКАЯ КАРТА АМБУЛАТОРНОГО БОЛЬНОГО № <?=$formData['cardNumber']; ?></h3>
</div>
<div id="card-data">
    <div class="card-line">
        1. Страховая медицинская организация: <b><?=$formData['insuranceCompany'];?></b>
    </div>
    <div class="card-line">
        <?php if(isset($formData['policyNumber'])) : ?>
        2. Полис: <b><?=$formData['policyNumber'];?></b>
        <?php else :?>
        2. Полис: _______________________________________________________________________________
        <?php endif; ?>
    </div>
    <div class="card-line">
        3. СНИЛС: <b><?=$formData['insuranceCertificate'];?></b>
    </div>
    <div class="card-line">
        <?php if(isset($formData['passport'])) : ?>
        4. Паспортные данные: <b><?=$formData['passport'];?></b>
        выдан: <b><?=$formData['fmsDepartment'].' '.$formData['passportDateOfIssue'];?></b>
        <?php else :?>
        4. Паспортные данные:_______________________________________________________________________________
        <?php endif; ?>
    </div>
    <div class="card-line">
        5. ФИО: <b><?=$formData['fullName'];?></b>
    </div>
    <div class="card-line">
        6. Пол: <b><?=$formData['genderDescription'];?></b>
    </div>
    <div class="card-line">
        7. Дата рождения: <b><?=$formData['dateBirth'];?></b>
    </div>
    <div class="card-line">
        8. Адрес постоянного места жительства: <b><?=$formData['address'];?></b>
    </div>
    <div class="card-line">
        9. Адрес регистрации по месту пребывания:
        ________________________________________________________________________________________________________
    </div>
    <div class="card-line">
        10. Телефон: ___________________________________________________________________________________________
    </div>
    <div class="card-line">
        11. Документ, удостоверяющий право на льготное лекарственное обеспечение:
        ______________________________________________________________________________________________________
    </div>
    <div class="card-line">
        12. Инвалидность: ___________________________________________________________________________________
    </div>
    <div class="card-line">
        <?php if(isset($formData['workplace'])) : ?>
        13. Место работы: <b><?=$formData['workplace'];?></b>
        <?php else :?>
        13. Место работы: ___________________________________________________________________________________
        <?php endif; ?>
    </div>
    <div class="card-line">
        <?php if(isset($formData['profession'])) : ?>
        14. Профессия: <b><?=$formData['profession'];?></b>
        <?php else :?>
        14. Профессия: ______________________________________________________________________________________
        <?php endif; ?>
    </div>
    <div class="card-line">
        15. Должность: ______________________________________________________________________________________
    </div>
    <div class="card-line">
        16. Иждевенец: ______________________________________________________________________________________
    </div>
</div>

