<?php

class Articles_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->table = 'articles';
        $this->result_mode = 'object';
        $this->primary_key = 'id';
    }

    function get_random_articles($user_type) {
        //$sql = "SELECT a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type != 'mini_certification' ORDER BY id DESC LIMIT 10;"; 
        if ($user_type == 'non_subscriber') {
            $sql = "SELECT a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type = '$user_type' ORDER BY id DESC LIMIT 10;";
        } elseif ($user_type == 'subscriber') {
            $sql = "SELECT a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type != 'mini_certification' ORDER BY id DESC LIMIT 10;";
        } else {
            $sql = "SELECT a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type != 'mini_certification' ORDER BY id DESC LIMIT 10;";
        }
        $query = $this->db->query($sql);
        //$query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function get_fav_random_articles($user_type = '') {
        //$sql1 = "SELECT distinct article_id FROM favourite_article ORDER BY created_on DESC LIMIT 5;";
        if ($user_type == 'non_subscriber') {
            $sql = "SELECT a.* FROM articles as a, category as c, favourite_article as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type = '$user_type'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        } elseif ($user_type == 'subscriber') {
            $sql = "SELECT a.* FROM articles as a, category as c, favourite_article as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type != 'mini_certification'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        } else {
            $sql = "SELECT a.* FROM articles as a, category as c, favourite_article as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type != 'mini_certification'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function get_viewed_random_articles() {
        //$sql1 = "SELECT distinct article_id FROM favourite_article ORDER BY created_on DESC LIMIT 5;";
        if ($user_type == 'non_subscriber') {

            $sql = "SELECT a.* FROM articles as a, category as c, articles_view_count as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type = '$user_type'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        } elseif ($user_type == 'subscriber') {
            $sql = "SELECT a.* FROM articles as a, category as c, articles_view_count as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type != 'mini_certification'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        } else {
            $sql = "SELECT a.* FROM articles as a, category as c, articles_view_count as fa 
                where a.active = '1' AND a.deleted = '0' AND c.id = a.cat_id AND c.deleted = '0' AND a.id=fa.article_id AND a.article_type != 'mini_certification'
                GROUP BY fa.article_id order by count(fa.article_id) desc limit 10;";
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function get_continue_watching($user_id) {
        //$this->db->select('video_time.*');
        $this->db->select('articles.id,articles.language_key,articles.title,articles.cat_id,articles.video_type,articles.url_link,articles.url_thumb,articles.url_duration,articles.description,articles.short_description,articles.active,articles.deleted,articles.created_on,articles.author_id,articles.article_type,articles.trailer_video,articles.trailer_thumb,articles.trailer_duration,video_time.user_id,video_time.assesment_id,video_time.start_time,video_time.end_time');
        $this->db->join('articles', 'articles.id=video_time.article_id', 'left');
        $this->db->join('assessment', 'assessment.id=video_time.assesment_id', 'left');
        $this->db->where('articles.article_type', 'mini_certification');
        $this->db->where('articles.active', '1');
        $this->db->where('articles.deleted', '0');
        $this->db->where('assessment.deleted', '0');
        $this->db->where('assessment.status', 'Active');
        // $this->db->where('articles.url_duration =','video_time.end_time');
        $this->db->where('video_time.user_id', $user_id);
        return $this->db->get('video_time')->result();
    }

    function get_recomend_articles($cat_id, $articletype, $id) {
        //$sql1 = "SELECT distinct article_id FROM favourite_article ORDER BY created_on DESC LIMIT 5;";
        if ($articletype == 'non_subscriber') {
            $sql = "SELECT distinct a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND  a.cat_id = '$cat_id' AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type = '$articletype' AND a.id != $id ORDER BY rand() DESC LIMIT 5;";
        } else {
            $sql = "SELECT distinct a.* FROM articles as a, category as c where a.active = '1' AND a.deleted = '0' AND  a.cat_id = '$cat_id' AND c.deleted = '0' AND c.parent_id != '0' AND a.article_type != 'mini_certification' AND a.id != $id ORDER BY rand() DESC LIMIT 5;";
        }
        $query = $this->db->query($sql);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            return null;
        }
    }

    function get_article_name($keyword, $user_type) {
        if ($user_type == 'subscriber') {
            $sql = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type != 'mini_certification' AND title LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' AND title LIKE '%$keyword%'";
        }
        $query = $this->db->query($sql);
        //$user_id = "SELECT id FROM users WHERE username LIKE '%$keyword%'";
        // $sql2 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' and id IN (SELECT Distinct GROUP_CONCAT(article_id) FROM article_tag WHERE tag_name LIKE '%$keyword%')";
        //$query2 = $this->db->query($sql2);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            $this->db->select('articles.*,users.username');
            $this->db->where('articles.deleted', '0');
            $this->db->where('articles.active', '1');
            if ($user_type == 'subscriber') {
                $this->db->where('articles.article_type !=', 'mini_certification');
            } else {
                $this->db->where('articles.article_type', $user_type);
            }
            $this->db->like('users.username', $keyword);
            $this->db->join('users', 'users.id=articles.author_id', 'left');
            return $this->db->get('articles')->result();

//            $sql1="SELECT *
//   FROM articles, users 
//WHERE articles.active = '1' AND articles.deleted = '0' AND articles.article_type = '$user_type' AND users.username LIKE '%$keyword%' 
//   AND  users.id = articles.author_id";
//           
//       //$sql1 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' and user_id IN (SELECT id FROM users WHERE username LIKE '%$keyword%')";
//            $query1 = $this->db->query($sql1);
//             //echo '<pre>'; print_r($query1->result()); exit;
//            if ($query1->num_rows() > 0) {
//                $row = $query1->result();
//                return $row;
//            }
        }
        return null;
    }

    function get_article_name1($keyword, $tag_id, $user_type) {
        if ($user_type == 'subscriber') {
            $sql = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type != 'mini_certification' AND title LIKE '%$keyword%' OR id IN ($tag_id)";
        } else {
            $sql = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' AND title LIKE '%$keyword%' OR id IN ($tag_id)";
        }
        $query = $this->db->query($sql);
        //$user_id = "SELECT id FROM users WHERE username LIKE '%$keyword%'";
        // $sql2 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' and id IN (SELECT Distinct GROUP_CONCAT(article_id) FROM article_tag WHERE tag_name LIKE '%$keyword%')";
        //$query2 = $this->db->query($sql2);
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        } else {
            $this->db->select('articles.*,users.username');
            $this->db->where('articles.deleted', '0');
            $this->db->where('articles.active', '1');
            $this->db->where('articles.article_type', $user_type);
            $this->db->like('users.username', $keyword);
            $this->db->join('users', 'users.id=articles.author_id', 'left');
            return $this->db->get('articles')->result();
//            $sql1 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' AND user_id  IN (SELECT username FROM users WHERE username LIKE '%$keyword%')";
//
//            $query1 = $this->db->query($sql1);
//            if ($query1->num_rows() > 0) {
//                $row = $query1->result();
//                return $row;
//            }
        }
        return null;
    }

    function get_articletag_name($keyword, $user_type) {
        if ($user_type == 'subscriber') {
            $sql = "SELECT Distinct GROUP_CONCAT(article_id) as article_id FROM article_tag,articles as a WHERE tag_name LIKE '%$keyword%' AND article_id = a.id AND a.active = '1' AND a.deleted = '0' AND a.article_type != 'mini_certification'";
        } else {
            $sql = "SELECT Distinct GROUP_CONCAT(article_id) as article_id FROM article_tag,articles as a WHERE tag_name LIKE '%$keyword%' AND article_id = a.id AND a.active = '1' AND a.deleted = '0' AND a.article_type = '$user_type'";
        }

        $query = $this->db->query($sql);
        $sql1 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' and user_id IN (SELECT id FROM users WHERE username LIKE '%$keyword%')";
        $query = $this->db->query($sql);
        $query1 = $this->db->query($sql1);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }

        return null;
    }

    function get_articletag_name_new($keyword, $user_type) {
        $sql = "SELECT Distinct GROUP_CONCAT(article_id) as article_id FROM article_tag,articles as a WHERE tag_name LIKE '%$keyword%' AND article_id = a.id AND a.active = '1' AND a.deleted = '0' AND a.article_type = '$user_type'";

        $query = $this->db->query($sql);
        $sql1 = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND article_type = '$user_type' and user_id IN (SELECT id FROM users WHERE username LIKE '%$keyword%')";
        $query = $this->db->query($sql);
        $query1 = $this->db->query($sql1);
        echo '<pre>';
        print_r($query1);
        exit;
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row;
        } elseif ($query1->num_rows() > 0) {
            $row = $query->row();
            return $row;
        }

        return null;
    }

    function get_article_lan($language, $user_type) {
        $sql = "SELECT * FROM articles WHERE active = '1' AND deleted = '0' AND language_key = '$language' AND article_type = '$user_type'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
    }

    function get_my_article($user_id) {
        $sql = "SELECT * FROM articles WHERE active = '1' and deleted = '0' and author_id = '$user_id' order by id desc";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function get_dept_article($aa, $subcat_id) {
        $sql = "SELECT * FROM articles WHERE id IN ($aa) AND active = '1' and deleted = '0' AND cat_id = $subcat_id";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function get_dept_article_lan($aa, $subcat_id, $language) {
        $sql = "SELECT * FROM articles WHERE id IN ($aa) AND active = '1' and deleted = '0' AND cat_id = $subcat_id AND language_key = '$language'";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
            return $row;
        }
        return null;
    }

    function get_approved_article() {
        $sql = "SELECT `a`.*, `u`.`username`, `c`.`name` as `category_name` FROM `articles` `a` JOIN `users` `u` ON `u`.`id` = `a`.`user_id` JOIN `category` `c` ON `c`.`id` = `a`.`cat_id` WHERE `a`.`active` = '1' AND `a`.`deleted` = '0' ORDER BY `a`.`created_on` DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

    function get_pending_article() {
        $sql = "SELECT `a`.*, `u`.`username`, `c`.`name` as `category_name` FROM `articles` `a` JOIN `users` `u` ON `u`.`id` = `a`.`user_id` JOIN `category` `c` ON `c`.`id` = `a`.`cat_id` WHERE `a`.`active` = '0' AND `a`.`deleted` = '0' ORDER BY `a`.`created_on` DESC";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
    }

    function get_user_list() {
        return $this->db->get('users')->result();
    }

    function get_image_list($id) {
        $this->db->where('user_id', $id);
        $this->db->where('cat_id', '0');
        $this->db->where('article_id', '0');
        $this->db->where('group_id', '0');

        return $this->db->get('image_files')->row();
    }

    function get_article_by_category($cat, $language = '', $user_type) {
        $this->db->where_in('cat_id', $cat);
        $this->db->where('active', '1');
        $this->db->where('deleted', '0');
        if (!empty($language)) {
            $this->db->where('language_key', $language);
        }
        $this->db->where('article_type !=', 'mini_certification');
        //$this->db->where('article_type ',$user_type);
        return $this->db->get('articles')->result();
    }

    function get_article_by_author_row($id) {
        // $this->db->where('group_company.company_id',$id);
        $this->db->where('deleted', '0');
        $this->db->where('active', '1');
        $this->db->where('article_type', 'mini_certification');
        $this->db->where('author_id', $id);
        return $this->db->get('articles')->row();
    }

    function get_article_by_author_result($id) {
        // $this->db->where('group_company.company_id',$id);
        $this->db->where('deleted', '0');
        $this->db->where('active', '1');
        $this->db->where('article_type', 'mini_certification');
        $this->db->where('author_id', $id);
        return $this->db->get('articles')->result();
    }

    function get_article_count($id) {
        $this->db->select('count(id) as article_count');
        $this->db->where('author_id', $id);
        $this->db->where('deleted', '0');
        $this->db->where('active', '1');
        $this->db->where('article_type !=', 'mini_certification');
        return $this->db->get('articles')->row();
    }

    function get_fav_article_count($id) {
        $this->db->select('count(id) as favarticle_count');
        $this->db->where('author_id', $id);
        return $this->db->get('favorite_author')->row();
    }

    function get_article_tag($articleid) {
        $this->db->where('article_id', $articleid);
        return $this->db->get('article_tag')->result();
    }

    function check_mini_cert($id) {
        $this->db->select('articles.*');
        $this->db->join('article_quiz', 'article_quiz.article_id=articles.id', 'left');
        $this->db->join('assessment_detail', 'assessment_detail.article_quiz_id=article_quiz.id', 'left');
        $this->db->join('assessment', 'assessment.id=assessment_detail.assesment_id', 'left');
        $this->db->where('article_quiz.article_id', $id);
        //$this->db->where('article_quiz.id','assessment_detail.assessment_detail');
        $this->db->where('assessment.deleted', '0');
        return $this->db->get('articles')->row();
    }

    function check_mini_cert1($id) {
        $this->db->join('assessment_detail', 'assessment_detail.article_quiz_id=article_quiz.id', 'left');
        $this->db->join('assessment', 'assessment.id=assessment_detail.assesment_id', 'left');
        $this->db->where('article_quiz.article_id', $id);
        $this->db->where('assessment.deleted', '0');
        return $this->db->get('article_quiz')->result();
    }

    function get_change1() {
        $data['url_link'] = 'https://player.vimeo.com/external/228468825.sd.mp4?s=dbb037963279f5d79c1923888f9f6dc4e1abc51e&profile_id=164';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648527985_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228468825.sd.mp4?s=dbb037963279f5d79c1923888f9f6dc4e1abc51e&profile_id=164';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648527985_295x166.jpg?r=pad';
        $this->db->where_in('id', array('21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38', '39', '40'));
        $this->db->update('articles', $data);
    }

    function get_change2() {
        $data['url_link'] = 'https://player.vimeo.com/external/228462954.sd.mp4?s=874ef94837e47553b926e4fcc7b949e66d81d0c3&profile_id=165';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648520970_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228462954.sd.mp4?s=874ef94837e47553b926e4fcc7b949e66d81d0c3&profile_id=165';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648520970_295x166.jpg?r=pad';
        $this->db->where_in('id', array('41', '42', '43', '44', '45', '46', '47', '48', '49', '50', '51', '52', '53', '54', '55', '56', '57', '58', '59', '60'));
        $this->db->update('articles', $data);
    }

    function get_change3() {
        $data['url_link'] = 'https://player.vimeo.com/external/228463288.sd.mp4?s=f76b2706f220e67c1f09b42b331d1c9d5845d067&profile_id=165';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648521146_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228463288.sd.mp4?s=f76b2706f220e67c1f09b42b331d1c9d5845d067&profile_id=165';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648521146_295x166.jpg?r=pad';
        $this->db->where_in('id', array('61', '62', '63', '64', '65', '66', '67', '68', '69', '70', '71', '72', '73', '74', '75', '76', '77', '78', '79', '80'));
        $this->db->update('articles', $data);
    }

    function get_change4() {
        $data['url_link'] = 'https://player.vimeo.com/external/228462208.sd.mp4?s=d6778cc0dae6e66d4beb2570cee7b1b6dec1cee5&profile_id=164';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648519659_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228462208.sd.mp4?s=d6778cc0dae6e66d4beb2570cee7b1b6dec1cee5&profile_id=164';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648519659_295x166.jpg?r=pad';
        $this->db->where_in('id', array('81', '82', '83', '84', '85', '86', '87', '88', '89', '90', '91', '92', '93', '94', '95', '96', '97', '98', '99', '100'));
        $this->db->update('articles', $data);
    }

    function get_change5() {
        $data['url_link'] = 'https://player.vimeo.com/external/228469559.sd.mp4?s=1e301c85df25270414d15ba02f507c585788f721&profile_id=165';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648528871_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228469559.sd.mp4?s=1e301c85df25270414d15ba02f507c585788f721&profile_id=165';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648528871_295x166.jpg?r=pad';
        $this->db->where_in('id', array('101', '102', '103', '104', '105', '106', '107', '108', '109', '110', '111', '112', '113', '114', '115', '116', '117', '118', '119', '120'));
        $this->db->update('articles', $data);
    }

    function get_change() {
        $data['url_link'] = 'https://player.vimeo.com/external/228469559.sd.mp4?s=1e301c85df25270414d15ba02f507c585788f721&profile_id=165';
        $data['url_thumb'] = 'https://i.vimeocdn.com/video/648528871_295x166.jpg?r=pad';
        $data['trailer_video'] = 'https://player.vimeo.com/external/228469559.sd.mp4?s=1e301c85df25270414d15ba02f507c585788f721&profile_id=165';
        $data['trailer_thumb'] = 'https://i.vimeocdn.com/video/648528871_295x166.jpg?r=pad';
        $this->db->where_in('id', array('121', '122', '123', '124', '125', '126', '127', '128', '129', '130', '131', '132', '133'));
        $this->db->update('articles', $data);
    }

    function delete_mini() {
        $this->db->where('article_type', 'mini_certification');
        $this->db->delete('articles');
    }

    function get_search_history($userid) {
        $this->db->where('user_id', $userid);
        //$this->db->where('assesment_id',$assesment_id); 
        return $this->db->get('search_history')->row();
    }

    function update_search_history($save, $user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->update('search_history', $save);
        return true;
    }

    function save_search_history($save) {
        $this->db->insert('search_history', $save);
        return $this->db->insert_id();
    }

    function delete_search_history($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->delete('search_history');
        return true;
    }

    function get_article_users($id) {
        $this->db->select('users.username as username,reviews.article_id,reviews.user_id');
        $this->db->where('article_id', $id);
        $this->db->join('users', 'users.id=reviews.user_id', 'left');
        return $this->db->get('reviews')->result();
    }

    function get_article_user_comments($articleid) {
        $this->db->select('reviews.*,users.username as username,users.email');
        $this->db->where('article_id', $articleid);
        //$this->db->where('user_id',$userid);
        $this->db->join('users', 'users.id=reviews.user_id', 'left');
        return $this->db->get('reviews')->result();
    }

    function get_bookmark_article($article_id, $user_id) {
        $this->db->select('bookmarks_article.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $this->db->where('deleted', '0');

        $query = $this->db->get('bookmarks_article');
        //echo $this->db->last_query();exit;
        // echo $query->num_rows(); exit;
        if ($query->num_rows() > 0) {
;
            return 1;
        } else {
            return 0;
        }
    }

    function get_bookmark_article_details($userid) {

        $this->db->select('bookmarks_folder.* , bookmarks_folder.id as folder_id ');
        $this->db->where('bookmarks_folder.user_id', $userid);
        $this->db->where('bookmarks_folder.deleted', '0');
        //$this->db->where('user_id',$userid);
        // echo $this->db->last_query();
        //$this->db->join('bookmarks_folder', 'bookmarks_article.folder_id=bookmarks_folder.id', 'left');
       // $this->db->group_by('folder_id');
        $query = $this->db->get('bookmarks_folder')->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    function get_user_book_marked_folder($user_id) {

        $this->db->select('bookmarks_article.folder_id,bookmarks_folder.folder_name as folder_name');
        $this->db->where('bookmarks_folder.user_id', $user_id);
        $this->db->where('bookmarks_folder.deleted', '0');
        
        //$this->db->where('user_id',$userid);
        // echo $this->db->last_query();
        $this->db->join('bookmarks_folder', 'bookmarks_article.folder_id=bookmarks_folder.id', 'left');
        $this->db->group_by('folder_id');
        $query = $this->db->get('bookmarks_article')->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    function get_book_marked_folder_article($user_id, $folder_id) {

        $this->db->select('bookmarks_article.*,bookmarks_folder.folder_name as folder_name');
        $this->db->where('bookmarks_article.user_id', $user_id);
        $this->db->where('bookmarks_article.folder_id', $folder_id);
        $this->db->where('bookmarks_article.deleted', '0');
        // echo $this->db->last_query();
        $this->db->join('bookmarks_folder', 'bookmarks_article.folder_id=bookmarks_folder.id', 'left');

        $query = $this->db->get('bookmarks_article')->result();
        // echo $this->db->last_query(); exit;
        return $query;
    }

    function save_bookmark_article_details($user_id, $article_id, $name, $folder_id) {
        $save['user_id'] = $user_id;
        $save['article_id'] = $article_id;
        $save['name'] = $name;
        //$save['stickers'] = $stickers;
        $save['folder_id'] = $folder_id;

        $this->db->insert('bookmarks_article', $save);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function insert_bookmark_folder_details($user_id, $folder_name) {
        $save['user_id'] = $user_id;
        $save['folder_name'] = $folder_name;
        $save['deleted'] = 0;

        $this->db->insert('bookmarks_folder', $save);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function check_bookmark_folder($user_id, $folder_name) {
        $this->db->select('bookmarks_folder.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('folder_name', $folder_name);
        $this->db->where('deleted', '0');
        // echo $this->db->last_query();
        return $this->db->get('bookmarks_folder')->result();
    }
    function check_bookmark_folder_details($user_id, $folder_id) {
        $this->db->select('bookmarks_folder.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $folder_id);
        $this->db->where('deleted', '0');
       
        return $this->db->get('bookmarks_folder')->row();
        // echo $this->db->last_query(); exit;
    }
    function check_bookmark_details($user_id, $article_id) {
        $this->db->select('bookmarks_article.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('article_id', $article_id);
        $this->db->where('deleted', '0');
       
        return $this->db->get('bookmarks_article')->row();
        // echo $this->db->last_query(); exit;
    }
    function delete_bookmark_folder_details($user_id, $bookmark_folder) {

        $save['deleted'] = '1';
        $this->db->where('folder_id', $bookmark_folder);
        $this->db->where('user_id', $user_id);
        $this->db->update('bookmarks_article', $save);


        $save['deleted'] = '1';
        $this->db->where('id', $bookmark_folder);
        $this->db->where('user_id', $user_id);
        $this->db->update('bookmarks_folder', $save);


        return true;
    }

    function delete_bookmark_article_details($user_id, $article_id) {
        //  echo $user_id; echo $bookmark_id; exit;
        $save['deleted'] = '1';
        $this->db->where('article_id', $article_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('bookmarks_article', $save);
        return true;
    }

    function get_notifications_details($userid) {
        $this->db->select('notification_settings.article,
        notification_settings.article_status,
        notification_settings.mini_certification,
        notification_settings.mini_certification_status,
        notification_settings.similar_assessment,
        notification_settings.similar_assessment_status');

        $this->db->where('user_id', $userid);
        //$this->db->where('user_id',$userid);
        // echo $this->db->last_query();
        return $this->db->get('notification_settings')->row();
    }

    function update_notifications_status_details($userid, $id, $status) {
        $this->db->select('notification_settings.*');
        $this->db->where('user_id', $userid);
        $query = $this->db->get('notification_settings');
        // echo $query->num_rows(); exit;
        if ($query->num_rows() > 0) {
            if ($id == '1') {
                $sql = "update notification_settings SET article_status='$status'  where user_id ='$userid'";
            } else if ($id == '2') {
                $sql = "update notification_settings SET mini_certification_status='$status'  where user_id ='$userid'";
            } else if ($id == '3') {
                $sql = "update notification_settings SET similar_assessment_status='$status'  where user_id ='$userid'";
            }
            $query = $this->db->query($sql);

            if ($query) {

                return TRUE;
            } else {
                return false;
            }
        } else {
            
            //article = 1,  mini_certification = 2, similar_assessment = 3.
            //default article_status = 1 , mini_certification_status= 1 , similar_assessment_status = 0  
            //After clicking remind me later similar_assessment_status get affected.
            
            if ($id == '1') {
                $save['user_id'] = $userid;
                $save['article'] = '1';
                $save['article_status'] = $status;
                
                $save['mini_certification'] = '2';
                $save['mini_certification_status'] = '1';
                $save['similar_assessment'] = '3';
                $save['similar_assessment_status'] = '0';
                
            } else if ($id == '2') {
                $save['user_id'] = $userid;
                $save['mini_certification'] = '2';
                $save['mini_certification_status'] = $status;
                
                 $save['article'] = '1';
                $save['article_status'] = '1';
                $save['similar_assessment'] = '3';
                $save['similar_assessment_status'] = '0';
                
            } else if ($id == '3') {
                $save['user_id'] = $userid;
                $save['similar_assessment'] = '3';
                $save['similar_assessment_status'] = $status;
                
                $save['article'] = '1';
                $save['article_status'] = '1';
                $save['mini_certification'] = '2';
                $save['mini_certification_status'] = '1';
      
            } 

            $this->db->insert('notification_settings', $save);
            return $this->db->insert_id();
        }
    }

    function get_user_notification_status($userid, $value) {
        if ($value == 'similar_assessment') {
            $this->db->select('notification_settings.similar_assessment,notification_settings.similar_assessment_status');
            $this->db->where('similar_assessment', "3");
        } else if ($value == 'mini_certification') {
            $this->db->select('notification_settings.mini_certification ,notification_settings.mini_certification_status');
            $this->db->where('mini_certification', "2");
        } else if ($value == 'article') {
            $this->db->select('notification_settings.article,notification_settings.article_status');
            $this->db->where('article', "1");
        }

        $this->db->where('user_id', $userid);
        $values = $this->db->get('notification_settings')->row();
        // echo $this->db->last_query(); exit;
        //echo $values->status; exit;


        if (!empty($value) && $value == 'article' && $values->article == 1 && $values->article_status == 1) {
            return true;
        } else if (!empty($value) && $value == 'mini_certification' && $values->mini_certification == 2 && $values->mini_certification_status == 1) {
            return true;
        } else if (!empty($value) && $value == 'similar_assessment' && $values->similar_assessment == 3 && $values->similar_assessment_status == 1) {
            return true;
        }
        return false;
    }
    
    
     function insert_category_article_details($user_id, $category_id) {
         // echo $user_id;  print_r($category_id); 
        if(!empty($category_id) && is_array($category_id)){
            foreach($category_id as $key => $category){
               //print_r($category);exit;
                if($this->check_category_exists_or_not($user_id, $category)){
                   
                    $save['status'] = 1;
                    $this->db->where('user_id', $user_id);
                    $this->db->where('category_id', $category);
                    $this->db->update('notification_article_category', $save);
               }
               else
               {
                   
                    $save['category_id'] = $category;
                    $save['user_id'] = $user_id;
                    $save['status'] = 1;
                    $this->db->insert('notification_article_category', $save);
               }
           }
            return true;
        }
        
        return false;
    }
    function update_category_article_details($user_id, $category_id) {
          //echo $user_id;  print_r($category_id); exit;
        if(!empty($category_id) && is_array($category_id)){
            foreach($category_id as $category){
           // $save['category_id'] = $category;
            //$save['user_id'] = $user_id;
//            $save['status'] = 0;
//            $this->db->where('user_id', $user_id);
//            $this->db->where('category_id', $category_id);
//            $this->db->update('notification_article_category', $save);
            
             if($this->check_category_exists_or_not($user_id, $category)){
                    $save['status'] = 0;
                    $this->db->where('user_id', $user_id);
                    $this->db->where('category_id', $category);
                    $this->db->update('notification_article_category', $save);
               }
               
               
           }
            return true;
        }
        return false;
    }
    function check_category_exists_or_not($user_id, $category_id){
        $this->db->select('notification_article_category.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('category_id', $category_id);
       
         $values =  $this->db->get('notification_article_category')->row();
        if(!empty($values)){
            return true;
        }
        // echo $this->db->last_query(); exit;
        return false;
    }
    
      function check_article_category_status($user_id, $cat_id) {
        $this->db->select('notification_article_category.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('category_id', $cat_id);
       
         $values =  $this->db->get('notification_article_category')->row();
        if(!empty($values)){
            return true;
        }
        // echo $this->db->last_query(); exit;
        return false;
      }
      function overall_review_ratings_insert_and_update($author_id, $type , $ratings = null) {
            $this->db->select('overall_review_ratings.*');
            $this->db->where('author_id', $author_id);

             $values =  $this->db->get('overall_review_ratings')->row();
            // echo $this->db->last_query(); exit;
            if(!empty($values)){
                if($type == 'create_article'){
                    $created_article_rewards = $values->created_article_rewards + 1;
                    $save['created_article_rewards'] = $created_article_rewards;
                }
                else if($type == 'ratings'){
                    $ratings_rewards = $values->ratings_rewards + $ratings;
                    $save['ratings_rewards'] = $ratings_rewards;
                }
                else if($type == 'reviews'){
                    $views_rewards = $values->views_rewards + 1;
                    $save['views_rewards'] = $views_rewards;
                }
                 else if($type == 'chats'){
                    $chats_rewards = $values->chats_rewards + 1;
                    $save['chats_rewards'] = $chats_rewards;
                }
                
                $this->db->where('author_id', $author_id);
                $this->db->update('overall_review_ratings', $save);
                  return true;
           }
           else
           {
                $save['author_id'] = $author_id;
                
                if($type == 'create_article'){
                    $save['created_article_rewards'] = 1;
                    $save['ratings_rewards'] = 0;
                    $save['views_rewards'] = 0;
                    $save['chats_rewards'] = 0;
                }
                else if($type == 'ratings'){
                    $save['ratings_rewards'] = $ratings;
                    $save['created_article_rewards'] = 0;
                    $save['views_rewards'] = 0;
                    $save['chats_rewards'] = 0;
                }
                else if($type == 'reviews'){
                    $save['views_rewards'] = 1;
                    $save['created_article_rewards'] = 0;
                    $save['ratings_rewards'] = 0;
                    $save['chats_rewards'] = 0;
                }
                 else if($type == 'chats'){
                   $save['chats_rewards'] = 1;
                   $save['created_article_rewards'] = 0;
                   $save['ratings_rewards'] = 0;
                   $save['views_rewards'] = 0;
                }
               // echo "<pre>"; print_r($save); 
                $this->db->insert('overall_review_ratings', $save);
               // echo $this->db->last_query(); exit;
                  return true;
           }
        
      }
     function insert_personalized_coaching_details($user_id, $author_id , $article_id , $likes_dislikes)
     {
        // echo $likes_dislikes; exit;
          if(!empty($author_id) && !empty($user_id)){
            $save['author_id'] = $author_id;
            $save['user_id'] = $user_id;
            $save['article_id'] = $article_id;
            $save['like'] = $likes_dislikes;
          }
        $this->db->insert('chat_articles', $save);
        
        if(!empty($likes_dislikes))
        {
            $this->overall_review_ratings_insert_and_update($author_id, "chats");
        }
        return true;
     }
     function update_leader_board($data)
     {
          //echo print_r($data); exit;
           if(!empty($data)){
              $this->db->insert('leader_board', $data);
              //echo $this->db->last_query(); exit;
                return true;
          }
            return false;
      
     }
      function get_leader_boards_details($user_id)
      {
         $this->db->select('img.raw_name as raw_name,img.file_ext as file_ext,users.username,leader_board.total_score');
         $this->db->join('users', 'users.id=leader_board.user_id', 'left');
          $this->db->join(' image_files img', 'img.user_id = users.id', 'left');
          
         $this->db->order_by('leader_board.total_score' ,'DESC');
                
         return $query = $this->db->get('leader_board')->result();
          //echo $this->db->last_query(); echo print_r($query); exit;
       }
       function get_leader_dashboard_details()
      {
         $this->db->select('img.raw_name as raw_name,img.file_ext as file_ext,users.username,leader_board.total_score');
         
         $this->db->join('users', 'users.id=leader_board.user_id', 'left');
         $this->db->join(' image_files img', 'img.user_id = users.id', 'left');
         
         $this->db->order_by('leader_board.total_score' ,'DESC');
                
         return $query = $this->db->get('leader_board')->result();
         // echo $this->db->last_query(); echo print_r($query); exit;
       } 
       
       function get_article_user_scores($article_id) {
        $this->db->select('reviews.*,users.username as username,users.email');
        $this->db->where('article_id', $articleid);
        //$this->db->where('user_id',$userid);
        $this->db->join('users', 'users.id=reviews.user_id', 'left');
        return $this->db->get('reviews')->result();
    }
}
