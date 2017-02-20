<?php

namespace frontend\controllers;

use common\models\Category;
use common\models\Comment;
use common\models\User;
use common\Yii02;
use frontend\models\PostForm;
use Yii;
use common\models\Post;
use common\models\search\PostSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index', 'create', 'upload', 'ueditor'
                ],
                'rules' => [
                    [
                        'actions' => [
                            'index'
                        ],
                        'allow' => true
                    ],
                    // 'roles' => ['?'],
                    [
                        'actions' => [
                            'create', 'upload', 'ueditor'
                        ],
                        'allow' => true,
                        'roles' => [
                            '@'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => [
                        'get', 'post'
                    ],
                    'create' => [
                        'get', 'post'
                    ]
                ]
            ]
        ];
    }

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction', // 这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}"
                ]
            ]
        ];

        return [
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    // 上传图片配置
                    'imageUrlPrefix' => Yii::$app->params['upload_url'], /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ]
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex($cid)
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        //zhi($model);exit;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cid' => $cid,
        ]);
    }

    public function actionIndex1()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index1', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = new PostForm();
        //zhi($model);exit;
        $data = $model->getViewById($id);
        //zhi($model['id']);exit;
        //$this->layout = "browser";
        $model = Post::findOne($id);
        //zhi($browser['id']);exit;
        $model->browser +=1;
        $model->update();

        $comment = Comment::find()->where(['post_id' => $model['id']])->asArray()->all();
        //zhi($comment);exit;
        $comment = Yii02::tree($comment);

        return $this->render('view', [
            'data' => $data,
            'comment' => $comment,
            'uid' => $model->user_id,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostForm();
        $model->setScenario(PostForm::SCENARIO_CREATE);

        $cate = Category::getAllCate();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create()) {
                Yii::$app->urlManager->createUrl(['post/create']);
            } else {
                return $this->redirect([
                    'post/view',
                    'id' => $model->id
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'cate' => $cate,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionComment($id)
    {
        $comment = new Comment();
        if (!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            $comment->user_id = $user->id;
            $comment->user_name = $user->username;
            $comment->img = $user->avatar;
            $comment->post_id = $id;
            $comment->status = 1;
            $comment->time = time();

            if ($comment->save()) {
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                return 'Error:评论错误';
            }
        }

    }
}
