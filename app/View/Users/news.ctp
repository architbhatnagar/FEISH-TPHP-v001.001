<div class="header-bg-wrapper">
    <div id="header-bg">
        <div class="container">
            <div class="header-bg-content">
                <h2 class="title"><?php echo $data['title']?></h2>
                <ol class="breadcrumb"><li><a href="">News Details</a></li><li class="active"><?php echo $data['title'];?></li></ol>
            </div>
        </div>
    </div>
</div>

<section class="center-section">
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-8 col-lg-9"  >


<div class="news-box" >
<div class="news-heading"><?php echo $data['title'];?></div>
<div class="written-by">
<span>Written by <i>admin</i></span>
<span class="span">Published: <i><?php echo  date('dS F, Y', strtotime($data['date'])); ?></i></span>
</div>

<div class="articleBody">

<header>Not all heart attacks produce chest pain or the other well-known classic symptoms. So-called silent heart attacks, however, can be just as deadly. New research, published in <em>Circulation</em>, measures the impact of these silent but serious cardiac events.</header>

<p>
The <a href="http://www.mayoclinic.org/diseases-conditions/heart-attack/in-depth/heart-attack-symptoms/art-20047744" target="_blank">typical symptoms</a> of a <a href="/articles/151444.php" title="Heart Attack: Symptoms, Diagnosis and Treatments" class="keywords">heart attack</a> include feelings of pressure, pain, fullness, and squeezing in the chest.
</p>
<p>
There may also be pain in the arms, shoulders, neck, back, teeth, or jaw. Stomach pain, shortness of breath, lightheadedness, sweating, nausea, and <a href="/info/anxiety/" title="What is Anxiety?" class="keywords">anxiety</a> are also common.
</p>
<p>
These can be referred to as the classic symptoms, but heart attacks do not always present in this way.
</p>
<p>
In reality, <a href="http://newsroom.heart.org/news/nearly-half-of-all-heart-attacks-may-be-silent?preview=252d" target="_blank">almost one half</a> of heart attacks do not display the majority of those symptoms. Yet, blood flow to the muscle of the heart is still reduced or cut off completely; this is referred to as ischemia.
</p>
<h2>The danger of silent heart attacks</h2>
<p>
Because of the lack of symptoms, silent heart attacks are rarely caught at the time of the event. It is normally at a later electrocardiogram (ECG) that the tell-tale signs are noted by a doctor.
</p>
<p>
Although these heart attacks do not exhibit symptoms, that does not mean they do no damage. Researchers from Wake Forest Baptist Medical Center, Winston-Salem, NC, led by Dr. Elsayed Z. Soliman, decided to investigate the outcome of these events in more detail. How common and how dangerous are silent heart attacks?
</p>
<blockquote><p>"The outcome of a silent heart attack is as bad as a heart attack that is recognized while it is happening. And because patients don't know they have had a silent heart attack, they may not receive the treatment they need to prevent another one." </p><p class="right">Elsayed Z. Soliman, M.D., MSc., M.S.</p></blockquote>
<p>
The team pooled data from 9,498 middle-aged adults who were involved in the Atherosclerosis Risk in Communities (ARIC) study. The study started recruiting in 1987. 
</p>
<p>
They enrolled healthy individuals, free of <a href="/articles/237191.php" title="Heart Disease: Definition, Causes, Research" class="keywords">heart disease</a>, from Minnesota, Maryland, Mississippi, and North Carolina. ARIC's initial aim was to investigate risk factors for heart disease and the health effects of hardening arteries (<a href="/articles/247837.php" title="Atherosclerosis: Causes, Symptoms and Treatments" class="keywords">atherosclerosis</a>).
</p>
<p>
For the current study, the team monitored the numbers of silent heart attacks and their future implications. They also looked for differences between African-Americans and Caucasians, and males and females.
</p>
<p>
The researchers had access to the data for each individual over an average of 9 years. During that time, 386 individuals had a heart attack that featured typical symptoms, and 317 people had silent heart attacks.
</p>
<p>
Each participant was then followed for more than 20 years, tracking heart-related disease, deaths from heart attacks, and other relevant health outcomes.
</p>
<h2>The data behind silent heart attacks</h2>
<p>
Dr. Soliman and his team found that silent heart attacks made up 45 percent of total heart attacks. They discovered that silent heart attacks tripled the chances of dying from heart disease later in life. The team also noted that they are more common in men than women, but that they are more commonly fatal in women.
</p>
<p>
Worryingly, silent heart attacks were found to increase the chances of dying from all causes by 34 percent. 
</p>
<p>
Additionally, African-Americans seemed to fare less well after a silent heart attack than Caucasians. However, the team advised that this result might be unreliable because of the relatively low numbers of African-Americans who took place in the trial.
</p>
<p>
The results were adjusted for a number of potentially confounding variables, such as smoking, <a href="/info/diabetes/" title="What is Diabetes?" class="keywords">diabetes</a>, weight, <a href="/articles/9152.php" title="Cholesterol: Causes, Symptoms and Treatments" class="keywords">cholesterol</a> levels, <a href="/articles/159283.php" title="High Blood Pressure: Causes, Symptoms and Treatments" class="keywords">high blood pressure</a>, income, and education.
</p>
<p>
Dr. Soliman hopes that this new evidence, showing how common and serious <a href="http://www.heart.org/HEARTORG/Conditions/HeartAttack/PreventionTreatmentofHeartAttack/Silent-Ischemia-and-Ischemic-Heart-Disease_UCM_434092_Article.jsp#.VzmNK6ODGko" target="_blank">silent heart attacks</a> are, might prompt changes in healthcare guidelines. Their findings demonstrate that individuals who experience silent heart attacks need the same level of care and support.
</p>
<blockquote><p>"Doctors need to help patients who have had a silent heart attack <a href="/articles/241302.php" title="How To Give Up Smoking" class="keywords">quit smoking</a>, reduce their weight, control cholesterol and <a href="/articles/270644.php" title="Blood Pressure: What Is Normal? How To Measure Blood Pressure" class="keywords">blood pressure</a>, and get more exercise."</p><p class="right">Dr. Elsayed Z. Soliman</p></blockquote>
<p>
As the medical and lay community become more aware of this quiet menace, Dr. Soliman hopes that silent heart attacks will be treated in the same rigorous and aggressive way as the more well-known version of heart attack.
</p>
<p>
<a href="/articles/309484.php">Learn about how shift workers are more susceptible to heart disease</a>.
</p>
<div class="author_bottom"><span class="author_byline">Written by <a href="/authors/tim-newman" class="article_author" rel="author" title="View all articles written by Tim Newman">Tim Newman</a></span></div></div>

</div>


</div>
<div class="col-xs-12 col-md-4 col-lg-3">
    <div class="box box-left">
        <div class="theme-heading">News</div>
        <div class="box-body">
          <div class="news-list">
          <ul>
          <?php foreach($news as $n){?>
          <li><a href="<?php echo $this->webroot."news/".$n['id']?>"><?php echo $n['title']?></a></li>
          <?php }?>
          </ul>
          </div>
        </div>
    </div>
    </div>
</div>
</div>
<section>