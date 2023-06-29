import pandas as pd
import numpy as np
# import sys
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
from sklearn.preprocessing import LabelEncoder
from sklearn.preprocessing import StandardScaler
from sklearn.neighbors import KNeighborsClassifier
from sklearn.model_selection import train_test_split
import logging

# Konfigurasi logger
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')
import pyswarms as ps
import json

dataset=pd.read_excel('/Applications/XAMPP/xamppfiles/htdocs/knn/assets/dist/xls/healthcare-dataset-stroke-data-no-missing-value.xls')
# dataset=pd.read_excel(sys.argv[1])

dataset.drop('id',axis=1,inplace=True)

dataset.dropna(axis=0,inplace=True)

dataset = dataset.drop(dataset[dataset['bmi'] == 28893237.0].index)

dataset = dataset.reset_index(drop=True)

cat_columns=['gender','ever_married','work_type','Residence_type','smoking_status']
le=LabelEncoder()
for i in cat_columns:
    dataset[i]=le.fit_transform(dataset[i])

x=np.array(dataset.drop(columns=['stroke']))
y=np.array(dataset['stroke'])

clf = KNeighborsClassifier(n_neighbors=3)
scaler = StandardScaler()
def f_per_particle(m, alpha):
  total_features = nfitur
  if np.count_nonzero(m) == 0:
    X_subset = x
  else:
    X_subset = x[:,m==1]
    xtrain, xtes, ytrain, ytes = train_test_split(X_subset,y, test_size=0.3, random_state=5, shuffle=True)
    clf.fit(xtrain, ytrain)
    P = (clf.predict(xtes) == ytes).mean()
    j = (alpha * (1.0 - P) + (1.0 - alpha) * (1 - (X_subset.shape[1] / total_features)))
    return j

def f(x, alpha=0.88):
    n_particles = x.shape[0]
    j = [f_per_particle(x[i], alpha) for i in range(n_particles)]
    return np.array(j)

# options = {'c1': 0.5, 'c2': 0.5, 'w':0.9, 'k': 30, 'p':2}
options = {'c1': 0.5, 'c2': 0.5, 'w':0.9, 'k': 3, 'p':2}
# options = {'c1': int(sys.argv[3]), 'c2': int(sys.argv[4]), 'w':int(sys.argv[5]), 'k': int(sys.argv[6]), 'p':int(sys.argv[7])}

nsampel, nfitur = x.shape
dimensions = nfitur
optimizer = ps.discrete.BinaryPSO(n_particles=30, dimensions=dimensions, options=options)

# iter = 100
iter = 1
# iter = int(sys.argv[8])
cost, pos = optimizer.optimize(f, iters=iter)

clf = KNeighborsClassifier(n_neighbors=3)

X_selected_features = x[:,pos==1]
xtrain, xtes, ytrain, ytes = train_test_split(X_selected_features, y, test_size=0.3, random_state=5, shuffle=True)
xtrain_scaled = scaler.fit_transform(xtrain)
xtes_scaled = scaler.transform(xtes)
clf.fit(xtrain_scaled, ytrain)

subset_performance = (clf.predict(xtes_scaled) == ytes).mean()
A_train, A_test, B_train, B_test = train_test_split(x, y, test_size = 0.2, random_state=5)
A_train_scaled = scaler.fit_transform(A_train)
A_test_scaled = scaler.transform(A_test)
clf.fit(A_train_scaled, B_train)
B_pred = clf.predict(A_test_scaled)

cm = confusion_matrix(B_test, B_pred)
report = classification_report(B_test, B_pred)
accuracy = round(accuracy_score(B_test, B_pred)*100,4)

cm_list = cm.tolist()
output = {
    'total_attributes': len(cat_columns),
    'attributes': cat_columns,
    'confusion_matrix': cm_list,
    'classification_report': report,
    'accuracy': accuracy
}
print(output)

# with open(sys.argv[2]+'/output_pso.json', 'w') as file:
with open('/Applications/XAMPP/xamppfiles/htdocs/knn/assets/dist/json/output_pso.json', 'w') as file:
    json.dump(output, file)
