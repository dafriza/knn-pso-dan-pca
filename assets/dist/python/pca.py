import pandas as pd
import numpy as np
import sys
import matplotlib.pyplot as plt
from sklearn.metrics import accuracy_score
from sklearn.preprocessing import LabelEncoder
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler
from sklearn.decomposition import PCA
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import classification_report, confusion_matrix
import json

# dataset = pd.read_excel('/Applications/XAMPP/xamppfiles/htdocs/knn/assets/dist/xls/healthcare-dataset-stroke-data-no-missing-value.xls')
dataset = pd.read_excel(sys.argv[1])
dataset.drop('id',axis=1,inplace=True)
dataset.dropna(axis=0,inplace=True)
dataset = dataset.drop(dataset[dataset['bmi'] == 28893237.0].index)
dataset = dataset.reset_index(drop=True)

cat_columns=['gender','ever_married','work_type','Residence_type','smoking_status']
le=LabelEncoder()
for i in cat_columns:
    dataset[i]=le.fit_transform(dataset[i])

x=dataset.drop('stroke', axis=1)
y=dataset['stroke']

xtrain,xtest,ytrain,ytest=train_test_split(x,y,test_size=0.2, random_state=0)

sc = StandardScaler()
xtrain = sc.fit_transform(xtrain)
xtest = sc.transform(xtest)

# n_component = 5
n_component = int(sys.argv[3])
pca = PCA(n_components = n_component)
xtrain = pca.fit_transform(xtrain)
xtest = pca.transform(xtest)

knn = KNeighborsClassifier(n_neighbors=3)
knn.fit(xtrain,ytrain)
ypred = knn.predict(xtest)

cm = confusion_matrix(ytest,ypred)
report = classification_report(ytest,ypred)
accuracy = round(accuracy_score(ytest,ypred)*100,4)

cm_list = cm.tolist()
output = {
    'total_attributes': len(cat_columns),
    'attributes': cat_columns,
    'confusion_matrix': cm_list,
    'classification_report': report,
    'accuracy': accuracy
}
print(output)
print(cm_list)
with open(sys.argv[2]+'output_pca.json', 'w') as file:
# with open('/Applications/XAMPP/xamppfiles/htdocs/knn/assets/dist/json/output_pca.json', 'w') as file:
    json.dump(output, file)
