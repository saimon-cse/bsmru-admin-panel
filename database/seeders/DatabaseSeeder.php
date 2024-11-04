<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Award;
use App\Models\Educations;
use App\Models\Experience;
use App\Models\Publications;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $fac_id = [10, 20, 30, 40];
        $fac_degree = [
            ["M.Sc. in Computer Science and Engineering", "B.Sc. in Computer Science and Engineering"],
            ["M.Sc. in Computer Science and Engineering", "B.Sc. in Computer Science and Engineering"],
            ["Master of Science in Software Engineering (MSSE)", "Bachelor of Science in Software Engineering (BSSE)"],
            ["M.Sc. in Computer Science and Engineering", "B.Sc. in Computer Science and Engineering"]
        ];

        $fac_institute = [
            ["Military Institute of Science and Technology", "Military Institute of Science and Technology"],
            ["Jahangirnagar University, Dhaka", "Jahangirnagar University, Dhaka"],
            ["Institute of Information Technology (IIT), University of Dhaka", "Institute of Information Technology (IIT), University of Dhaka"],
            ["Jahangirnagar University", "Jahangirnagar University"]
        ];

        $fac_passyear = [
            ["Ongoing", "2020"],
            ["2017", "2016"],
            ["2023", "2021"],
            ["2017", "2016"]
        ];

        $fac_award = [
            [],
            ["Third International Conference on Smart Systems: Innovations in Computing (SSIC)", "International Conference on Machine Intelligence and Data Science Application (MIDAS)"],
            ["International", "National"],
            []
        ];

        $fac_awardtitle = [
            [],
            ["Best Paper Award", "Best Paper Award"],
            ["2023 ACM SIGSOFT Distinguished Paper - Best Regular Paper (Software Ecosystems) at the ACM/IEEE 11th International Workshop on Software Engineering for Systems-of-Systems and Software Ecosystems (SESoS 2023)", "Masters Fellowship from ICT Division, Government of Bangladesh"],
            []
        ];

        $fac_awardyear = [
            [],
            ["2021", "2021"],
            ["2023", "2021-22"],
            []
        ];

        $fac_awardcountry = [
            [],
            ["India", "Bangladesh"],
            ["Australia", "Bangladesh"],
            []
        ];

        $fac_awarddescription = [
            [],
            ["", ""],
            ["", ""],
            []
        ];

        $fac_exptitle = [
            ["Lecturer, Department of Computer Science and Engineering", "Lecturer, Department of Computer Science and Engineering"],
            ["Lecturer", "Lecturer (Senior Scale)", "Lecturer"],
            ["Product Manager", "Software Engineer Intern"],
            ["Lecturer at Department of Computer Science and Engineering", "Lecturer (Sr. Scale) at Department of Computer Science and Engineering", "Lecturer at Department of Computer Science and Engineering", "Lecturer (Contractual) at Department of Computer Science and Engineering"]
        ];

        $fac_exporgan = [
            ["Military Institute of Science and Technology", "University of Information Technology and Sciences (UITS)"],
            ["Department of Computer Science and Engineering, Bangabandhu Sheikh Mujibur Rahman University, Kishoreganj", "Department of Computer Science and Engineering, Daffodil International University, Dhaka", "Department of Computer Science and Engineering, Daffodil International University, Dhaka"],
            ["ProSpotters", "Secured Link Services (SELISE)"],
            ["Bangabandhu Sheikh Mujibur Rahman University, Kishoreganj, Bangladesh", "Daffodil International University, Dhaka, Bangladesh", "Daffodil International University, Dhaka, Bangladesh", "Daffodil International University, Dhaka, Bangladesh"]
        ];

        $fac_expfrom = [
            ["1 Jul 2020", "15 Jan 2020"],
            ["5 Feb 2023", "1 Jan 2022", "5 Sep 2018"],
            ["Aug 2023", "Jan 2020"],
            ["Oct 2023", "Jan 2022", "Jan 2019", "Sep 2017"]
        ];

        $fac_expto = [
            ["Ongoing", "Ongoing"],
            ["Ongoing", "31 Jan 2023", "31 Dec 2021"],
            ["Dec 2023", "Sep 2020"],
            ["Ongoing", "Sep 2023", "Sep 2021", "Dec 2018"]
        ];

        $fac_pubtype = [
            ["National Conference", "National Conference", "National Journal"],
            ["International Conference", "International Journal"],
            ["International Conference", "International Journal"],
            ["International Conference", "International Journal"]
        ];

        $fac_pubdesc = [
            ["A Web-based Bangla Handwritten Character Recognition System using Machine Learning", "Prediction of Annual Energy Output of Wind Power Generator from Different Machine Learning Algorithm: Comprehensive Study", "Image Encryption using Chaotic Logistic Mapping"],
            ["Deep learning-based diabetic retinopathy detection using transfer learning and hyperparameter tuning", "A novel approach for developing a paperless automated solution for student course evaluation: Comparative case study among private universities in Bangladesh"],
            ["Deep learning-based model to predict the onset of breast cancer utilizing classification algorithms", "Leveraging Software Reusability to Predict System Reliability: A Machine Learning Approach"],
            ["An Innovative Approach to Enhanced Security in the Internet of Things Using Blockchain Technology", "Big Data Analytics in Healthcare: Challenges and Opportunities"]
        ];

        $users = [
            [
                'name' => 'Asaduzzaman Khan, M. A., Ph.D',
                'user_id' => 'T-001',
                'researchInt' => 'Computer Vision, Pattern Recognition, Machine Learning, Image Processing',
                'institute' => 'Military Institute of Science and Technology',
                'role' => 'admin',
                'phone' => '01711223344',
                'type' => 'Teacher',
                'designation' => 'Professor',
                'special_desig' => 'Dean, Faculty of Computer Science and Engineering',
                'rank' => '0',
                'controller_role' => 'Admin',
                'display_email' => 'dr.asaduzzaman@mist.ac.bd',
                'email' => 'asaduzzaman@example.com',
                'password' => Hash::make('password'), // Add a password for each user
            ],
            // ... add more users as needed
        ];

        foreach ($users as $user) {
            $userModel = User::create($user);
            $index = $userModel->id - 1;

            // Check if the index exists in the arrays before accessing them
            if (isset($fac_degree[$index])) {
                foreach ($fac_degree[$index] as $key => $degree) {
                    Educations::create([
                        'user_id' => $userModel->id,
                        'degree' => $degree,
                        'institution' => $fac_institute[$index][$key],
                        'passYear' => $fac_passyear[$index][$key],
                        'rank' => $key + 1,
                    ]);
                }
            }

            if (isset($fac_award[$index])) {
                foreach ($fac_award[$index] as $key => $award) {
                    Award::create([
                        'user_id' => $userModel->id,
                        'type' => $award,
                        'title' => $fac_awardtitle[$index][$key],
                        'year' => $fac_awardyear[$index][$key],
                        'country' => $fac_awardcountry[$index][$key],
                        'description' => $fac_awarddescription[$index][$key],
                        'rank' => $key + 1,
                    ]);
                }
            }

            if (isset($fac_exptitle[$index])) {
                foreach ($fac_exptitle[$index] as $key => $title) {
                    Experience::create([
                        'user_id' => $userModel->id,
                        'title' => $title,
                        'organization' => $fac_exporgan[$index][$key],
                        'from_date' => $fac_expfrom[$index][$key],
                        'to_date' => $fac_expto[$index][$key],
                        'rank' => $key + 1,
                    ]);
                }
            }

            if (isset($fac_pubtype[$index])) {
                foreach ($fac_pubtype[$index] as $key => $type) {
                    Publications::create([
                        'user_id' => $userModel->id,
                        'type' => $type,
                        'description' => $fac_pubdesc[$index][$key],
                        'rank' => $key + 1,
                    ]);
                }
            }
        }
    }
}
